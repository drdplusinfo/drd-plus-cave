<?php
namespace DrdPlus\Cave\UnitBundle\Controller;

use Drd\DiceRoll\Templates\Rollers\Roller1d6;
use DrdPlus\Codes\GenderCodes;
use DrdPlus\Codes\ProfessionCodes;
use DrdPlus\Codes\RaceCodes;
use DrdPlus\Exceptionalities\Choices\Fortune;
use DrdPlus\Exceptionalities\Choices\PlayerDecision;
use DrdPlus\Exceptionalities\Fates\FateOfCombination;
use DrdPlus\Exceptionalities\Fates\FateOfExceptionalProperties;
use DrdPlus\Exceptionalities\Fates\FateOfGoodRear;
use DrdPlus\Exceptionalities\Properties\ExceptionalityPropertiesFactory;
use DrdPlus\Person\ProfessionLevels\ProfessionFirstLevel;
use DrdPlus\Professions\Profession;
use DrdPlus\Tables\Measurements\Experiences\Experiences;
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
                'subRaces' => RaceCodes::getSubraceCodes(),
                'genders' => GenderCodes::getGenderCodes(),
                'professions' => ProfessionCodes::getProfessionCodes(),
                'person' => $this->getPersonValues($request)
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
        $tables = $this->container->get('drd_plus_cave_tables.tables');

        return [
            'name' => 'The Chosen One',
            'race' => $race = current(RaceCodes::getRaceCodes()),
            'subRace' => $subrace = current(RaceCodes::getSubRaceCodes()[$race]),
            'gender' => $gender = current(GenderCodes::getGenderCodes()),
            'profession' => current(ProfessionCodes::getProfessionCodes()),
            'height' => $tables->getRacesTable()->getHeightInCm($race, $subrace),
            'weight' => $tables->getRacesTable()->getWeightInKg(
                $race,
                $subrace,
                $gender,
                $tables->getFemaleModifiersTable(),
                $tables->getWeightTable()
            ),
            'age' => 15,
            'experiences' => 0,
        ];
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
                'person' => $person,
                'choices' => [
                    $this->getExceptionalityFactory()->getFortune(),
                    $this->getExceptionalityFactory()->getPlayerDecision()
                ],
                'fates' => [
                    $this->getExceptionalityFactory()->getFateOfGoodRear(),
                    $this->getExceptionalityFactory()->getFateOfCombination(),
                    $this->getExceptionalityFactory()->getFateOfExceptionalProperties(),
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
        $professionLevel = $this->getProfessionLevel($request);
        $roller1d6 = new Roller1d6();
        $fortuneProperties = (new ExceptionalityPropertiesFactory())->createFortuneProperties(
            $fate,
            $professionLevel,
            $roller1d6->roll()->getValue(),
            $roller1d6->roll()->getValue(),
            $roller1d6->roll()->getValue(),
            $roller1d6->roll()->getValue(),
            $roller1d6->roll()->getValue(),
            $roller1d6->roll()->getValue(),
            $this->container->get('drd_plus_cave_unit.base_properties_factory')
        );

        return $this->render(
            '@DrdPlusCaveUnit/Person/fortune-properties.html.twig',
            [
                'backUrl' => $this->generateUrl('drd_plus_cave_unit_choice_and_fate', $request->query->all()),
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

    private function getProfessionLevel(Request $request)
    {
        $professionCode = $request->query->get('person')['profession'];
        $profession = Profession::getItByCode($professionCode);

        return ProfessionFirstLevel::createFirstLevel($profession);
    }

    private function playerDecisionPropertiesAction(Request $request)
    {
        $fate = $this->findSelectedFate($request);

        return $this->render(
            '@DrdPlusCaveUnit/Person/player-decision-properties.html.twig',
            [
                'backUrl' => $this->generateUrl('drd_plus_cave_unit_choice_and_fate', $request->query->all()),
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
     * @return \DrdPlus\Exceptionalities\ExceptionalityFactory
     */
    private function getExceptionalityFactory()
    {
        return $this->container->get('drd_plus_cave_unit.exceptionality_factory');
    }

    private function isPersonValid(array $person)
    {
        if (count($person) === 0) {
            return false;
        }
        $personKeys = array_keys($this->getDefaultPersonValues());
        $notEmpty = array_filter($personKeys, function ($key) use ($person) {
            return isset($person[$key]) && $person[$key] !== '';
        });

        return count($personKeys) === count($notEmpty);
    }

    private function extendPersonByDeterminedValues(array $person)
    {
        $experiences = new Experiences($person['experiences'], $this->container->get('drd_plus_cave_tables.tables')->getExperiencesTable());
        $person['level'] = $experiences->getLevel()->getValue();

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

        return $this->getExceptionalityFactory()->getChoice($properties['choice']);
    }

    /**
     * @param Request $request
     * @return false|FateOfCombination|FateOfExceptionalProperties|FateOfGoodRear
     */
    private function findSelectedFate(Request $request)
    {
        $properties = $request->get('properties');
        if (!isset($properties['fate'])) {
            return false;
        }

        return $this->getExceptionalityFactory()->getFate($properties['fate']);
    }

}
