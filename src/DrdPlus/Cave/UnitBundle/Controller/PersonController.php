<?php
namespace DrdPlus\Cave\UnitBundle\Controller;

use Drd\DiceRoll\Roll;
use Drd\DiceRoll\Templates\DiceRolls\Dice1d6Roll;
use Drd\DiceRoll\Templates\Rollers\Roller1d6;
use Drd\DiceRoll\Templates\Rolls\Roll1d6;
use DrdPlus\Background\Background;
use DrdPlus\Background\BackgroundParts\Ancestry;
use DrdPlus\Background\BackgroundParts\SkillsFromBackground;
use DrdPlus\Codes\Armaments\BodyArmorCode;
use DrdPlus\Codes\Armaments\HelmCode;
use DrdPlus\Codes\Armaments\MeleeWeaponCode;
use DrdPlus\Codes\GenderCode;
use DrdPlus\Codes\History\ChoiceCode;
use DrdPlus\Codes\History\FateCode;
use DrdPlus\Codes\ProfessionCode;
use DrdPlus\Codes\RaceCode;
use DrdPlus\Codes\SubRaceCode;
use DrdPlus\Equipment\Belongings;
use DrdPlus\Equipment\Equipment;
use DrdPlus\Person\Attributes\Name;
use DrdPlus\GamingSession\Memories;
use DrdPlus\Person\Person;
use DrdPlus\Person\ProfessionLevels\ProfessionFirstLevel;
use DrdPlus\Person\ProfessionLevels\ProfessionLevels;
use DrdPlus\Person\ProfessionLevels\ProfessionZeroLevel;
use DrdPlus\Professions\Commoner;
use DrdPlus\Professions\Profession;
use DrdPlus\Properties\Base\Agility;
use DrdPlus\Properties\Base\Charisma;
use DrdPlus\Properties\Base\Intelligence;
use DrdPlus\Properties\Base\Knack;
use DrdPlus\Properties\Base\Strength;
use DrdPlus\Properties\Base\Will;
use DrdPlus\Properties\Body\Age;
use DrdPlus\Properties\Body\HeightInCm;
use DrdPlus\Properties\Body\WeightInKg;
use DrdPlus\PropertiesByFate\ChosenProperties;
use DrdPlus\PropertiesByFate\FortuneProperties;
use DrdPlus\Skills\Combined\CombinedSkills;
use DrdPlus\Skills\Physical\PhysicalSkills;
use DrdPlus\Skills\Psychical\PsychicalSkills;
use DrdPlus\Skills\Skills;
use DrdPlus\Tables\Measurements\Experiences\Experiences;
use DrdPlus\Tables\Measurements\Experiences\Level;
use DrdPlus\Tables\Tables;
use Granam\Integer\IntegerObject;
use Granam\Integer\PositiveIntegerObject;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PersonController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function personAction(Request $request)
    {
        return $this->render(
            '@DrdPlusCaveUnit/Person/person.html.twig',
            [
                'races' => RaceCode::getPossibleValues(),
                'subRaces' => SubRaceCode::getPossibleValues(),
                'genders' => GenderCode::getPossibleValues(),
                'professions' => ProfessionCode::getPossibleValues(),
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

    /**
     * @return array
     */
    private function getDefaultPersonValues()
    {
        return [
            'name' => 'The Chosen One',
            'race' => $race = current(RaceCode::getPossibleValues()),
            'subRace' => $subrace = current(SubRaceCode::getRaceToSubRaceValues()[$race]),
            'gender' => $gender = current(GenderCode::getPossibleValues()),
            'profession' => current(ProfessionCode::getPossibleValues()),
            'heightInCm' => $this->getTables()->getRacesTable()->getHeightInCm(RaceCode::getIt($race), SubRaceCode::getIt($subrace)),
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
        return $this->get('drd_plus_cave_unit.tables');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function choiceAndFateAction(Request $request)
    {
        $person = $request->query->get('person', []);
        if (!$this->isPersonValid($person)) {
            return $this->personAction($request);
        }
        $person = $this->extendPersonByDeterminedValues($person);

        $choiceCode = $this->findSelectedChoiceCode($request);
        $fate = $this->findSelectedFateCode($request);

        return $this->render(
            '@DrdPlusCaveUnit/Person/choice-and-fate.html.twig',
            [
                'backUrl' => $this->generateUrl('drd_plus_cave_unit_person', $request->query->all()),
                'nextUrl' => $this->generateUrl('drd_plus_cave_unit_exceptionality_properties'),
                'person' => $person,
                'choices' => ChoiceCode::getPossibleValues(),
                'fates' => FateCode::getPossibleValues(),
                'selected' => [
                    'previous' => $request->query->all(),
                    'choice' => $choiceCode,
                    'fate' => $fate,
                ],
            ]
        );
    }

    /**
     * @param Request $request
     * @return bool|\Symfony\Component\HttpFoundation\Response
     */
    public function exceptionalityPropertiesAction(Request $request)
    {
        $safetyRedirect = $this->getPersonRedirectIfNotValid($request)
            ?: $this->getChoiceAndFateRedirectIfNotValid($request);
        if ($safetyRedirect) {
            return $safetyRedirect;
        }

        $choice = $this->findSelectedChoiceCode($request);

        switch ($choice->getValue()) {
            case ChoiceCode::PLAYER_DECISION :
                return $this->playerDecisionPropertiesAction($request);
            case ChoiceCode::FORTUNE :
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
        $choice = $this->findSelectedChoiceCode($request);
        $fate = $this->findSelectedFateCode($request);
        if (!$this->isChoiceAndFateValid($choice, $fate)) {
            return $this->choiceAndFateAction($request);
        }

        return false;
    }

    private function fortunePropertiesAction(Request $request)
    {
        $fateCode = $this->findSelectedFateCode($request);
        $profession = $this->findSelectedProfession($request);
        $roller1d6 = new Roller1d6();
        $fortuneProperties = new FortuneProperties(
            $this->getRoll('strengthRoll', $request, $roller1d6),
            $this->getRoll('agilityRoll', $request, $roller1d6),
            $this->getRoll('knackRoll', $request, $roller1d6),
            $this->getRoll('willRoll', $request, $roller1d6),
            $this->getRoll('intelligenceRoll', $request, $roller1d6),
            $this->getRoll('charismaRoll', $request, $roller1d6),
            $fateCode,
            $profession,
            $this->getTables(),
            $this->getBasePropertiesFactory()
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
                ],
            ]
        );
    }

    private function getRoll($rollName, Request $request, Roller1d6 $roller1D6)
    {
        if ($this->findSelectedPropertiesValue($request, $rollName) !== null) {
            $value = $this->findSelectedPropertiesValue($request, $rollName);

            return new Roll([new Roll1d6(new Dice1d6Roll(new IntegerObject($value)))]);
        }

        return $roller1D6->roll();
    }

    /**
     * @return \DrdPlus\Properties\Base\BasePropertiesFactory
     */
    private function getBasePropertiesFactory()
    {
        return $this->get('drd_plus_cave_unit.base_properties_factory');
    }

    /**
     * @return ProfessionZeroLevel
     */
    private function createZeroProfessionLevel()
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return ProfessionZeroLevel::createZeroLevel(Commoner::getIt());
    }

    /**
     * @param Profession $profession
     * @return ProfessionFirstLevel
     */
    private function createFirstProfessionLevel(Profession $profession)
    {
        return ProfessionFirstLevel::createFirstLevel($profession);
    }

    /**
     * @param Request $request
     * @return Profession
     */
    private function findSelectedProfession(Request $request)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return Profession::getItByCode(ProfessionCode::getIt($this->getSelectedPersonValue($request, 'profession')));
    }

    /**
     * @param Request $request
     * @param string $key
     * @return string
     */
    private function getSelectedPersonValue(Request $request, $key)
    {
        return $request->query->get('person')[$key];
    }

    /**
     * @param Request $request
     * @param string $key
     * @return null|string
     */
    private function findSelectedPropertiesValue(Request $request, $key)
    {
        return array_key_exists($key, $request->query->get('properties'))
            ? $request->query->get('properties')[$key]
            : null;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function playerDecisionPropertiesAction(Request $request)
    {
        $fateCode = $this->findSelectedFateCode($request);

        return $this->render(
            '@DrdPlusCaveUnit/Person/player-decision-properties.html.twig',
            [
                'backUrl' => $this->generateUrl('drd_plus_cave_unit_choice_and_fate', $request->query->all()),
                'nextUrl' => $this->generateUrl('drd_plus_cave_unit_person_overview'),
                'selected' => [
                    'previous' => $request->query->all(),
                ],
                'maximum' => $this->getTables()->getPlayerDecisionsTable()->getMaximumToSingleProperty($fateCode),
            ]
        );
    }

    private function isChoiceAndFateValid($choice, $fate)
    {
        return $choice && $fate;
    }

    /**
     * @param array $person
     * @return bool
     */
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
     * @return false|ChoiceCode
     */
    private function findSelectedChoiceCode(Request $request)
    {
        $properties = $request->get('properties');
        if (!isset($properties['choice'])) {
            return false;
        }

        return ChoiceCode::getIt($properties['choice']);
    }

    /**
     * @param Request $request
     * @return false|FateCode
     */
    private function findSelectedFateCode(Request $request)
    {
        $properties = $request->get('properties');
        if (!isset($properties['fate'])) {
            return false;
        }

        return FateCode::getIt($properties['fate']);
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
                'personProperties' => $person->getCurrentProperties($this->getTables()),
                'choice' => $choice = $this->findSelectedChoiceCode($request),
                'fate' => $this->findSelectedFateCode($request),
                /*'backgroundSkillPoints' => [
                    'physicalSkillPoints' => $person->getSkills()->getPhysicalSkills(),
                    'psychicalSkillPoints' => $person->getSkills()->getPsychicalSkills(),
                    'combinedSkillPoints' => $person->getSkills()->getCombinedSkills(),
                ],*/
                'remarkableSense' => $person->getRace()->getRemarkableSense($this->getTables()),
            ]
        );
    }

    /**
     * @param Request $request
     * @return Person
     */
    private function createPersonFromRequest(Request $request)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return new Person(
            $this->findSelectedName($request),
            $this->findSelectedRace($request),
            $this->findSelectedGender($request),
            $this->findSelectedPropertiesByFate($request),
            $this->findSelectedMemories(),
            $professionLevels = $this->createProfessionLevels($request),
            $this->createBackground($this->findSelectedFateCode($request)),
            $this->createPersonSkills($professionLevels, $this->createAncestry()),
            $this->findSelectedWeightInKgAdjustment($request),
            $this->findSelectedHeightInCm($request),
            $this->findSelectedAge($request),
            new Equipment(
                new Belongings(),
                BodyArmorCode::getIt(BodyArmorCode::WITHOUT_ARMOR),
                HelmCode::getIt(HelmCode::WITHOUT_HELM),
                MeleeWeaponCode::getIt(MeleeWeaponCode::HAND),
                MeleeWeaponCode::getIt(MeleeWeaponCode::HAND)
            ),
            $this->getTables()
        );
    }

    /**
     * @param Request $request
     * @return \DrdPlus\Races\Race
     */
    private function findSelectedRace(Request $request)
    {
        return $this->getRacesFactory()->getSubRaceByCodes(
            RaceCode::getIt($this->getSelectedPersonValue($request, 'race')),
            SubRaceCode::getIt($this->getSelectedPersonValue($request, 'subRace'))
        );
    }

    /**
     * @return \DrdPlus\Races\RacesFactory
     */
    private function getRacesFactory()
    {
        return $this->get('drd_plus_cave_unit.races_factory');
    }

    /**
     * @param Request $request
     * @return GenderCode
     */
    private function findSelectedGender(Request $request)
    {
        return GenderCode::getIt($this->getSelectedPersonValue($request, 'gender'));
    }

    /**
     * @param Request $request
     * @return Name
     */
    private function findSelectedName(Request $request)
    {
        return new Name($this->getSelectedPersonValue($request, 'name'));
    }

    /**
     * @param Request $request
     * @return ChosenProperties|FortuneProperties
     * @throws \RuntimeException
     */
    private function findSelectedPropertiesByFate(Request $request)
    {
        $fateCode = $this->findSelectedFateCode($request);
        $choice = $this->findSelectedChoiceCode($request);
        $profession = $this->findSelectedProfession($request);
        switch ($choice->getValue()) {
            case ChoiceCode::FORTUNE :
                return new FortuneProperties(
                    $this->createRoll1d6('strengthRoll', $request),
                    $this->createRoll1d6('agilityRoll', $request),
                    $this->createRoll1d6('knackRoll', $request),
                    $this->createRoll1d6('willRoll', $request),
                    $this->createRoll1d6('intelligenceRoll', $request),
                    $this->createRoll1d6('charismaRoll', $request),
                    $fateCode,
                    $profession,
                    $this->getTables(),
                    $this->get('drd_plus_cave_unit.base_properties_factory')
                );
            case ChoiceCode::PLAYER_DECISION :
                return new ChosenProperties(
                    Strength::getIt($this->getSelectedPropertyValue($request, 'strength')),
                    Agility::getIt($this->getSelectedPropertyValue($request, 'agility')),
                    Knack::getIt($this->getSelectedPropertyValue($request, 'knack')),
                    Will::getIt($this->getSelectedPropertyValue($request, 'will')),
                    Intelligence::getIt($this->getSelectedPropertyValue($request, 'intelligence')),
                    Charisma::getIt($this->getSelectedPropertyValue($request, 'charisma')),
                    $fateCode,
                    $profession,
                    $this->getTables()
                );
            default :
                throw new \RuntimeException;
        }
    }

    /**
     * @param string $rollName
     * @param Request $request
     * @return Roll1d6
     */
    private function createRoll1d6($rollName, Request $request)
    {
        return new Roll1d6(new Dice1d6Roll(new IntegerObject($this->getSelectedPropertyValue($request, $rollName))));
    }

    /**
     * @param Request $request
     * @param string $key
     * @return string
     */
    private function getSelectedPropertyValue(Request $request, $key)
    {
        return $request->query->get('properties')[$key];
    }

    /**
     * @return Memories
     */
    private function findSelectedMemories()
    {
        $memories = new Memories();
        $memories->createAdventure('Childhood');

        return $memories;
    }

    /**
     * @param Request $request
     * @return ProfessionLevels
     */
    private function createProfessionLevels(Request $request)
    {
        return ProfessionLevels::createIt(
            $this->createZeroProfessionLevel(),
            $this->createFirstProfessionLevel($this->findSelectedProfession($request))
        );
    }

    /**
     * @param FateCode $fateCode
     * @return Background
     */
    private function createBackground(FateCode $fateCode)
    {
        $zero = new PositiveIntegerObject(0);

        return Background::createIt($fateCode, $zero, $zero, $zero, $this->getTables());
    }

    /**
     * @return Ancestry
     */
    private function createAncestry()
    {
        return Ancestry::getIt(new PositiveIntegerObject(0), $this->getTables());
    }

    /**
     * @param ProfessionLevels $professionLevels
     * @param Ancestry $ancestry
     * @return Skills
     */
    private function createPersonSkills(ProfessionLevels $professionLevels, Ancestry $ancestry)
    {
        return Skills::createSkills(
            $professionLevels,
            SkillsFromBackground::getIt(new PositiveIntegerObject(0), $ancestry, $this->getTables()),
            $this->createPersonPhysicalSkills(),
            $this->createPersonPsychicalSkills(),
            $this->createPersonCombinedSkills(),
            $this->getTables()
        );
    }

    /**
     * @return PhysicalSkills
     */
    private function createPersonPhysicalSkills()
    {
        return new PhysicalSkills($this->createZeroProfessionLevel());
    }

    /**
     * @return PsychicalSkills
     */
    private function createPersonPsychicalSkills()
    {
        return new PsychicalSkills($this->createZeroProfessionLevel());
    }

    /**
     * @return CombinedSkills
     */
    private function createPersonCombinedSkills()
    {
        return new CombinedSkills($this->createZeroProfessionLevel());
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