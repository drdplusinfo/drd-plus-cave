<?php
namespace DrdPlus\Cave\UnitBundle\Controller;

use Drd\DiceRoll\Templates\Rollers\Roller1d6;
use Drd\Genders\Gender;
use DrdPlus\Codes\GenderCodes;
use DrdPlus\Codes\ProfessionCodes;
use DrdPlus\Codes\RaceCodes;
use DrdPlus\Exceptionalities\Choices\Fortune;
use DrdPlus\Exceptionalities\Choices\PlayerDecision;
use DrdPlus\Exceptionalities\Exceptionality;
use DrdPlus\Exceptionalities\Fates\ExceptionalityFate;
use DrdPlus\Exceptionalities\Fates\FateOfCombination;
use DrdPlus\Exceptionalities\Fates\FateOfExceptionalProperties;
use DrdPlus\Exceptionalities\Fates\FateOfGoodRear;
use DrdPlus\Exceptionalities\Properties\ExceptionalityPropertiesFactory;
use DrdPlus\Person\Attributes\Name;
use DrdPlus\Person\Background\Background;
use DrdPlus\Person\Background\BackgroundParts\BackgroundSkillPoints;
use DrdPlus\Person\Background\BackgroundParts\Heritage;
use DrdPlus\Person\GamingSession\Memories;
use DrdPlus\Person\Person;
use DrdPlus\Person\ProfessionLevels\ProfessionFirstLevel;
use DrdPlus\Person\ProfessionLevels\ProfessionLevels;
use DrdPlus\Person\Skills\Combined\PersonCombinedSkills;
use DrdPlus\Person\Skills\PersonSkills;
use DrdPlus\Person\Skills\Physical\PersonPhysicalSkills;
use DrdPlus\Person\Skills\Psychical\PersonPsychicalSkills;
use DrdPlus\Professions\Profession;
use DrdPlus\Properties\Body\Age;
use DrdPlus\Properties\Body\HeightInCm;
use DrdPlus\Properties\Body\WeightInKg;
use DrdPlus\Tables\Measurements\Experiences\Experiences;
use DrdPlus\Tables\Measurements\Experiences\Level;
use DrdPlus\Tables\Tables;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PersonController extends Controller
{
    public function personAction(Request $request)
    {
        return $this->render(
            '@DrdPlusCaveUnit/Person/person.html.twig',
            [
                'races' => RaceCodes::getRaceCodes(),
                'subRaces' => RaceCodes::getSubRaceCodes(),
                'genders' => GenderCodes::getGenderCodes(),
                'professions' => ProfessionCodes::getProfessionCodes(),
                'person' => $this->getPersonValues($request),
                'maxExperiences' => (new Level(Level::MAX_LEVEL, $this->getTables()->getExperiencesTable()))->getTotalExperiences(),
            ]
        );
    }

    /**
     * @param Request $request
     * @return array|string
     */
    private function getPersonValues(Request $request)
    {
        $defaultValues = $this->getDefaultPersonValues();
        $requested = $request->query->get('person', []);

        return array_merge(
            $defaultValues,
            $requested // same (string) keys are overwritten
        );
    }

    private function getDefaultPersonValues()
    {
        return [
            'name' => 'The Chosen One',
            'race' => $race = current(RaceCodes::getRaceCodes()),
            'subRace' => $subrace = current(RaceCodes::getSubRaceCodes()[$race]),
            'gender' => $gender = current(GenderCodes::getGenderCodes()),
            'profession' => current(ProfessionCodes::getProfessionCodes()),
            'heightInCm' => $this->getTables()->getRacesTable()->getHeightInCm($race, $subrace),
            'weightInKgAdjustment' => 0,
            'age' => 15,
            'experiences' => 0,
        ];
    }

    /**
     * @return Tables
     */
    private function getTables()
    {
        return $this->container->get('drd_plus_cave_tables.tables');
    }

    public function choiceAndFateAction(Request $request)
    {
        $person = $request->query->get('person', []);
        if (!$this->isPersonValid($person)) {
            return $this->personAction($request);
        }
        $person = $this->extendPersonByDeterminedValues($person);

        $choice = $this->findSelectedChoice($request);
        $fate = $this->findSelectedFate($request);

        return $this->render(
            '@DrdPlusCaveUnit/Person/choice-and-fate.html.twig',
            [
                'backUrl' => $this->generateUrl('drd_plus_cave_unit_person', $request->query->all()),
                'nextUrl' => $this->generateUrl('drd_plus_cave_unit_exceptionality_properties'),
//                'person' => $person,
                'choices' => [
                    $this->getExceptionalitiesFactory()->getFortune(),
                    $this->getExceptionalitiesFactory()->getPlayerDecision()
                ],
                'fates' => [
                    $this->getExceptionalitiesFactory()->getFateOfGoodRear(),
                    $this->getExceptionalitiesFactory()->getFateOfCombination(),
                    $this->getExceptionalitiesFactory()->getFateOfExceptionalProperties(),
                ],
                'selected' => [
                    'previous' => $request->query->all(),
                    'choice' => $choice,
                    'fate' => $fate,
                ],
            ]
        );
    }

    public function exceptionalityPropertiesAction(Request $request)
    {
        $safetyRedirect = $this->getPersonRedirectIfNotValid($request)
            ?: $this->getChoiceAndFateRedirectIfNotValid($request);
        if ($safetyRedirect) {
            return $safetyRedirect;
        }

        $choice = $this->findSelectedChoice($request);

        switch ($choice::getCode()) {
            case PlayerDecision::PLAYER_DECISION :
                return $this->playerDecisionPropertiesAction($request);
            case Fortune::FORTUNE :
                return $this->fortunePropertiesAction($request);
            default :
                return $this->choiceAndFateAction($request); //step back
        }
    }

    private function getPersonRedirectIfNotValid(Request $request)
    {
        $person = $request->query->get('person', []);
        if (!$this->isPersonValid($person)) {
            return $this->personAction($request); // few steps back
        }

        return false;
    }

    private function getChoiceAndFateRedirectIfNotValid(Request $request)
    {
        $choice = $this->findSelectedChoice($request);
        $fate = $this->findSelectedFate($request);
        if (!$this->isChoiceAndFateValid($choice, $fate)) {
            return $this->choiceAndFateAction($request);
        }

        return false;
    }

    private function fortunePropertiesAction(Request $request)
    {
        $fate = $this->findSelectedFate($request);
        $professionLevel = $this->createFirstProfessionLevel($this->findSelectedProfession($request));
        $roller1d6 = new Roller1d6();
        $fortuneProperties = $this->getExceptionalityPropertiesFactory()->createFortuneProperties(
            $fate,
            $professionLevel,
            $this->findSelectedPropertiesValue($request, 'strengthRoll') !== null
                ? $this->findSelectedPropertiesValue($request, 'strengthRoll')
                : $roller1d6->roll()->getValue(),
            $this->findSelectedPropertiesValue($request, 'agilityRoll') !== null
                ? $this->findSelectedPropertiesValue($request, 'agilityRoll')
                : $roller1d6->roll()->getValue(),
            $this->findSelectedPropertiesValue($request, 'knackRoll') !== null
                ? $this->findSelectedPropertiesValue($request, 'knackRoll')
                : $roller1d6->roll()->getValue(),
            $this->findSelectedPropertiesValue($request, 'willRoll') !== null
                ? $this->findSelectedPropertiesValue($request, 'willRoll')
                : $roller1d6->roll()->getValue(),
            $this->findSelectedPropertiesValue($request, 'intelligenceRoll') !== null
                ? $this->findSelectedPropertiesValue($request, 'intelligenceRoll')
                : $roller1d6->roll()->getValue(),
            $this->findSelectedPropertiesValue($request, 'charismaRoll') !== null
                ? $this->findSelectedPropertiesValue($request, 'charismaRoll')
                : $roller1d6->roll()->getValue(),
            $this->container->get('drd_plus_cave_unit.base_properties_factory')
        );

        return $this->render(
            '@DrdPlusCaveUnit/Person/fortune-properties.html.twig',
            [
                'backUrl' => $this->generateUrl('drd_plus_cave_unit_choice_and_fate', $request->query->all()),
                'nextUrl' => $this->generateUrl('drd_plus_cave_unit_person_overview'),
                'selected' => [
                    'previous' => $request->query->all(),
                ],
                'rolled' => [
                    'strength' => $fortuneProperties->getStrength(),
                    'strengthRoll' => $fortuneProperties->getStrengthRoll(),
                    'agility' => $fortuneProperties->getAgility(),
                    'agilityRoll' => $fortuneProperties->getAgilityRoll(),
                    'knack' => $fortuneProperties->getKnack(),
                    'knackRoll' => $fortuneProperties->getKnackRoll(),
                    'will' => $fortuneProperties->getWill(),
                    'willRoll' => $fortuneProperties->getWillRoll(),
                    'intelligence' => $fortuneProperties->getIntelligence(),
                    'intelligenceRoll' => $fortuneProperties->getIntelligenceRoll(),
                    'charisma' => $fortuneProperties->getCharisma(),
                    'charismaRoll' => $fortuneProperties->getCharismaRoll(),
                ]
            ]
        );
    }

    private function createFirstProfessionLevel(Profession $profession)
    {
        return ProfessionFirstLevel::createFirstLevel($profession);
    }

    private function findSelectedProfession(Request $request)
    {
        return Profession::getItByCode($this->getSelectedPersonValue($request, 'profession'));
    }

    private function getSelectedPersonValue(Request $request, $key)
    {
        return $request->query->get('person')[$key];
    }

    private function findSelectedPropertiesValue(Request $request, $key)
    {
        return array_key_exists($key, $request->query->get('properties'))
            ? $request->query->get('properties')[$key]
            : null;
    }

    private function playerDecisionPropertiesAction(Request $request)
    {
        $fate = $this->findSelectedFate($request);

        return $this->render(
            '@DrdPlusCaveUnit/Person/player-decision-properties.html.twig',
            [
                'backUrl' => $this->generateUrl('drd_plus_cave_unit_choice_and_fate', $request->query->all()),
                'nextUrl' => $this->generateUrl('drd_plus_cave_unit_person_overview'),
                'selected' => [
                    'previous' => $request->query->all(),
                ],
                'maximum' => $fate->getUpToSingleProperty(),
            ]
        );
    }

    private function isChoiceAndFateValid($choice, $fate)
    {
        return $choice && $fate;
    }

    /**
     * @return \DrdPlus\Exceptionalities\ExceptionalitiesFactory
     */
    private function getExceptionalitiesFactory()
    {
        return $this->container->get('drd_plus_cave_unit.exceptionalities_factory');
    }

    /**
     * @return ExceptionalityPropertiesFactory
     */
    private function getExceptionalityPropertiesFactory()
    {
        return $this->container->get('drd_plus_cave_unit.exceptionality_properties_factory');
    }

    private function isPersonValid($person)
    {
        if (!is_array($person)) {
            return false;
        }
        if (count($person) === 0) {
            return false;
        }
        $personKeys = array_keys($this->getDefaultPersonValues());
        $notEmpty = array_filter($personKeys, function ($key) use ($person) {
            return array_key_exists($key, $person) && $person[$key] !== '';
        });

        return count($personKeys) === count($notEmpty);
    }

    private function extendPersonByDeterminedValues(array $person)
    {
        $experiences = new Experiences($person['experiences'], $this->getTables()->getExperiencesTable());
        $person['level'] = $experiences->getTotalLevel()->getValue();

        return $person;
    }

    /**
     * @param Request $request
     * @return false|Fortune|PlayerDecision
     */
    private function findSelectedChoice(Request $request)
    {
        $properties = $request->get('properties');
        if (!isset($properties['choice'])) {
            return false;
        }

        return $this->getExceptionalitiesFactory()->getChoice($properties['choice']);
    }

    /**
     * @param Request $request
     * @return false|ExceptionalityFate|FateOfCombination|FateOfExceptionalProperties|FateOfGoodRear
     */
    private function findSelectedFate(Request $request)
    {
        $properties = $request->get('properties');
        if (!isset($properties['fate'])) {
            return false;
        }

        return $this->getExceptionalitiesFactory()->getFate($properties['fate']);
    }

    public function personOverviewAction(Request $request)
    {
        $person = $this->createPersonFromRequest($request);
        $experiences = new Experiences($person->getMemories()->getExperiences($this->getTables()->getExperiencesTable())->getValue(), $this->getTables()->getExperiencesTable());
        $availableLevel = $experiences->getTotalLevel();

        return $this->render(
            '@DrdPlusCaveUnit/Person/person-overview.html.twig',
            [
                'backUrl' => $this->generateUrl('drd_plus_cave_unit_exceptionality_properties', $request->query->all()),
                'selected' => [
                    'previous' => $request->query->all(),
                ],
                'person' => $person,
                'availableLevel' => $availableLevel,
                'personProperties' => $person->getPersonProperties($this->getTables()),
                'choice' => $choice = $this->findSelectedChoice($request),
                'fate' => $this->findSelectedFate($request),
                'backgroundSkillPoints' => [
                    'physicalSkillPoints' => $person->getBackground()->getBackgroundSkillPoints()->getPhysicalSkillPoints(
                        $person->getProfession(),
                        $this->getTables()
                    ),
                    'psychicalSkillPoints' => $person->getBackground()->getBackgroundSkillPoints()->getPsychicalSkillPoints(
                        $person->getProfession(),
                        $this->getTables()
                    ),
                    'combinedSkillPoints' => $person->getBackground()->getBackgroundSkillPoints()->getCombinedSkillPoints(
                        $person->getProfession(),
                        $this->getTables()
                    ),
                ],
                'remarkableSense' => $person->getRace()->getRemarkableSense($this->getTables()->getRacesTable()),
            ]
        );
    }

    private function createPersonFromRequest(Request $request)
    {
        return new Person(
            $this->findSelectedRace($request),
            $this->findSelectedGender($request),
            $this->findSelectedName($request),
            $this->createExceptionalityFromRequest($request),
            $this->findSelectedMemories($request),
            $professionLevels = $this->createProfessionLevels($request),
            $this->createBackground($this->findSelectedFate($request)),
            $this->createPersonSkills($professionLevels, $this->createHeritageFromRequest($request), $request),
            $this->findSelectedWeightInKgAdjustment($request),
            $this->findSelectedHeightInCm($request),
            $this->findSelectedAge($request),
            $this->getTables()
        );
    }

    private function findSelectedRace(Request $request)
    {
        return $this->getRacesFactory()->getSubRaceByCodes(
            $this->getSelectedPersonValue($request, 'race'),
            $this->getSelectedPersonValue($request, 'subRace')
        );
    }

    /**
     * @return \DrdPlus\Races\RacesFactory
     */
    private function getRacesFactory()
    {
        return $this->container->get('drd_plus_cave_unit.races_factory');
    }

    /**
     * @param Request $request
     * @return Gender
     */
    private function findSelectedGender(Request $request)
    {
        return Gender::getGenderByCode($this->getSelectedPersonValue($request, 'gender'));
    }

    private function findSelectedName(Request $request)
    {
        return Name::getIt($this->getSelectedPersonValue($request, 'name'));
    }

    private function createExceptionalityFromRequest(Request $request)
    {
        return new Exceptionality(
            $this->findSelectedChoice($request),
            $this->findSelectedFate($request),
            $this->findSelectedExceptionalityProperties($request)
        );
    }

    private function findSelectedExceptionalityProperties(Request $request)
    {
        $fate = $this->findSelectedFate($request);
        $choice = $this->findSelectedChoice($request);
        $professionLevel = $this->createFirstProfessionLevel($this->findSelectedProfession($request));
        switch ($choice->getValue()) {
            case Fortune::FORTUNE :
                return $this->getExceptionalityPropertiesFactory()->createFortuneProperties(
                    $fate,
                    $professionLevel,
                    $this->getSelectedPropertyValue($request, 'strengthRoll'),
                    $this->getSelectedPropertyValue($request, 'agilityRoll'),
                    $this->getSelectedPropertyValue($request, 'knackRoll'),
                    $this->getSelectedPropertyValue($request, 'willRoll'),
                    $this->getSelectedPropertyValue($request, 'intelligenceRoll'),
                    $this->getSelectedPropertyValue($request, 'charismaRoll'),
                    $this->container->get('drd_plus_cave_unit.base_properties_factory')
                );
            case PlayerDecision::PLAYER_DECISION :
                return $this->getExceptionalityPropertiesFactory()->createChosenProperties(
                    $fate,
                    $professionLevel,
                    $this->getSelectedPropertyValue($request, 'strength'),
                    $this->getSelectedPropertyValue($request, 'agility'),
                    $this->getSelectedPropertyValue($request, 'knack'),
                    $this->getSelectedPropertyValue($request, 'will'),
                    $this->getSelectedPropertyValue($request, 'intelligence'),
                    $this->getSelectedPropertyValue($request, 'charisma')
                );
            default :
                throw new \RuntimeException;
        }
    }

    private function getSelectedPropertyValue(Request $request, $key)
    {
        return $request->query->get('properties')[$key];
    }

    private function findSelectedMemories(Request $request)
    {
        $memories = new Memories();
        $memories->createAdventure('Childhood');

        return $memories;
    }

    private function createProfessionLevels(Request $request)
    {
        return ProfessionLevels::createIt(
            $this->createFirstProfessionLevel($this->findSelectedProfession($request))
        );
    }

    /**
     * @param ExceptionalityFate $fate
     * @return Background
     */
    private function createBackground(ExceptionalityFate $fate)
    {
        return Background::createIt($fate, 0, 0, 0);
    }

    private function createHeritageFromRequest(Request $request)
    {
        return Heritage::getIt(0);
    }

    /**
     * @param ProfessionLevels $professionLevels
     * @param Heritage $heritage
     * @param Request $request
     * @return PersonSkills
     */
    private function createPersonSkills(
        ProfessionLevels $professionLevels,
        Heritage $heritage,
        Request $request
    )
    {
        return PersonSkills::createPersonSkills(
            $professionLevels,
            BackgroundSkillPoints::getIt(0, $heritage),
            $this->getTables(),
            $this->createPersonPhysicalSkills($request),
            $this->createPersonPsychicalSkills($request),
            $this->createPersonCombinedSkills($request)
        );
    }

    /**
     * @param Request $request
     * @return PersonPhysicalSkills
     */
    private function createPersonPhysicalSkills(Request $request)
    {
        return new PersonPhysicalSkills();
    }

    /**
     * @param Request $request
     * @return PersonPsychicalSkills
     */
    private function createPersonPsychicalSkills(Request $request)
    {
        return new PersonPsychicalSkills();
    }

    /**
     * @param Request $request
     * @return PersonCombinedSkills
     */
    private function createPersonCombinedSkills(Request $request)
    {
        return new PersonCombinedSkills();
    }

    /**
     * @param Request $request
     * @return WeightInKg
     */
    private function findSelectedWeightInKgAdjustment(Request $request)
    {
        return WeightInKg::getIt($this->getSelectedPersonValue($request, 'weightInKgAdjustment'));
    }

    /**
     * @param Request $request
     * @return HeightInCm
     */
    private function findSelectedHeightInCm(Request $request)
    {
        return HeightInCm::getIt($this->getSelectedPersonValue($request, 'heightInCm'));
    }

    /**
     * @param Request $request
     * @return Age
     */
    private function findSelectedAge(Request $request)
    {
        return Age::getIt($this->getSelectedPersonValue($request, 'age'));
    }

}
