<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\Properties;

use DrdPlus\Cave\TablesBundle\Tables\Fatigue\FatigueTable;
use DrdPlus\Cave\TablesBundle\Tables\Tables;
use DrdPlus\Cave\TablesBundle\Tables\Weight\WeightTable;
use DrdPlus\Cave\TablesBundle\Tables\Wounds\WoundsTable;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\ExceptionalityProperties;
use DrdPlus\Cave\UnitBundle\Person\Attributes\GameCharacteristics\Combat\Attack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\GameCharacteristics\Combat\Defense;
use DrdPlus\Cave\UnitBundle\Person\Attributes\GameCharacteristics\Combat\Fight;
use DrdPlus\Cave\UnitBundle\Person\Attributes\GameCharacteristics\Combat\Shooting;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body\Size;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body\WeightInKg;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived\Endurance;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived\Senses;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived\Speed;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived\Toughness;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\PersonProperties;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Person\Professions\Profession;
use DrdPlus\Cave\UnitBundle\Person\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Races\Race;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;
use Granam\Strict\Object\StrictObject;
use Mockery\MockInterface;

class PersonPropertiesTest extends TestWithMockery
{

    /**
     * @return PersonProperties
     *
     * @test
     */
    public function properties_are_calculated_properly()
    {
        $personProperties = new PersonProperties(
            $this->createRace(
                $raceStrengthModifier = 3,
                $raceAgilityModifier = 2,
                $raceKnackModifier = 1,
                $raceWillModifier = 1,
                $raceIntelligenceModifier = 1,
                $raceCharismaModifier = 1,
                $sizeModifier = 1,
                $toughnessModifier = 2,
                $sensesModifier = 3,
                $raceWeightInKgModifier = 50.0
            ),
            $this->createGender(),
            $this->createExceptionalityProperties(
                $exceptionalStrength = 2,
                $exceptionalAgility = 3,
                $exceptionalKnack = 2,
                $exceptionalWill = 2,
                $exceptionalIntelligence = 2,
                $exceptionalCharisma = 2
            ),
            $this->createProfessionLevels(
                $firstProfessionStrength = 1,
                $firstProfessionAgility = 0,
                $firstProfessionKnack = 1,
                $firstProfessionWill = 1,
                $firstProfessionIntelligence = 1,
                $firstProfessionCharisma = 1,
                $firstProfessionWeightInKg = 1.0,
                $nextLevelsStrength = 5,
                $nextLevelAgility = 8,
                $nextLevelKnack = 4,
                $nextLevelWill = 4,
                $nextLevelIntelligence = 4,
                $nextLevelCharisma = 4,
                $nextLevelsWeightInKg = 0.0
            ),
            /*            $this->createPersonMock(
                            $raceStrengthModifier = 3, $exceptionalStrength = 2, $firstProfessionStrength = 1, $nextLevelsStrength = 5,
                            $raceAgilityModifier = 2, $exceptionalAgility = 3, $firstProfessionAgility = 0, $nextLevelAgility = 8,
                            $raceKnackModifier = 1, $exceptionalKnack = 2, $firstProfessionKnack = 1, $nextLevelKnack = 4,
                            $raceWillModifier = 1, $exceptionalWill = 2, $firstProfessionWill = 1, $nextLevelWill = 4,
                            $raceIntelligenceModifier = 1, $exceptionalIntelligence = 2, $firstProfessionIntelligence = 1, $nextLevelIntelligence = 4,
                            $raceCharismaModifier = 1, $exceptionalCharisma = 2, $firstProfessionCharisma = 1, $nextLevelCharisma = 4,
                            $sizeModifier = 1, $toughnessModifier = 2, $sensesModifier = 3,
                            $raceWeightInKgModifier = 50.0, $firstProfessionWeightInKg = 1.0, $nextLevelsWeightInKg = 0.0
                        ),*/
            $this->createTablesMock()
        );
        $strength = $personProperties->getStrength();
        $this->assertInstanceOf(Strength::class, $strength);
        $this->assertSame($raceStrengthModifier + $exceptionalStrength + $firstProfessionStrength + $nextLevelsStrength, $strength->getValue());

        $agility = $personProperties->getAgility();
        $this->assertInstanceOf(Agility::class, $agility);
        $this->assertSame($raceAgilityModifier + $exceptionalAgility + $firstProfessionAgility + $nextLevelAgility, $agility->getValue());

        $knack = $personProperties->getKnack();
        $this->assertInstanceOf(Knack::class, $knack);
        $this->assertSame($raceKnackModifier + $exceptionalKnack + $firstProfessionKnack + $nextLevelKnack, $knack->getValue());

        $will = $personProperties->getWill();
        $this->assertInstanceOf(Will::class, $will);
        $this->assertSame($raceWillModifier + $exceptionalWill + $firstProfessionWill + $nextLevelWill, $will->getValue());

        $intelligence = $personProperties->getIntelligence();
        $this->assertInstanceOf(Intelligence::class, $intelligence);
        $this->assertSame($raceIntelligenceModifier + $exceptionalIntelligence + $firstProfessionIntelligence + $nextLevelIntelligence, $intelligence->getValue());

        $charisma = $personProperties->getCharisma();
        $this->assertInstanceOf(Charisma::class, $charisma);
        $this->assertSame($raceCharismaModifier + $exceptionalCharisma + $firstProfessionCharisma + $nextLevelCharisma, $charisma->getValue());

        $weightInKg = $personProperties->getWeightInKg();
        $this->assertInstanceOf(WeightInKg::class, $weightInKg);
        $this->assertSame($raceWeightInKgModifier + $firstProfessionWeightInKg + $nextLevelsWeightInKg, $weightInKg->getValue());

        // DERIVED

        $toughness = $personProperties->getToughness();
        $this->assertInstanceOf(Toughness::class, $toughness);
        $this->assertSame($personProperties->getStrength()->getValue() + $toughnessModifier, $toughness->getValue());

        $endurance = $personProperties->getEndurance();
        $this->assertInstanceOf(Endurance::class, $endurance);
        $this->assertSame((int)round($personProperties->getStrength()->getValue() + $personProperties->getWill()->getValue()), $endurance->getValue());

        $speed = $personProperties->getSpeed();
        $this->assertInstanceOf(Speed::class, $speed);
        $this->assertSame(
            (int)(round(($personProperties->getStrength()->getValue() + $personProperties->getAgility()->getValue()) / 2)
                + (ceil($personProperties->getSize()->getValue() / 3) - 2)),
            $speed->getValue()
        );

        $size = $personProperties->getSize();
        $this->assertInstanceOf(Size::class, $size);
        $firstProfessionStrengthSummary = $firstProfessionStrength + $exceptionalStrength;
        $this->assertSame(
            $sizeModifier + ($firstProfessionStrengthSummary === 0
                ? -1
                : ($firstProfessionStrengthSummary === 1
                    ? 0
                    : 1
                )
            ),
            $size->getValue()
        );

        $senses = $personProperties->getSenses();
        $this->assertInstanceOf(Senses::class, $senses);
        $this->assertSame($personProperties->getKnack()->getValue() + $sensesModifier, $senses->getValue());

        // BATTLE

        $fight = $personProperties->getFight();
        $this->assertInstanceOf(Fight::class, $fight);

        $attack = $personProperties->getAttack();
        $this->assertInstanceOf(Attack::class, $attack);
        $this->assertSame((int)floor($personProperties->getAgility()->getValue() / 2), $attack->getValue());

        $defense = $personProperties->getDefense();
        $this->assertInstanceOf(Defense::class, $defense);
        $this->assertSame((int)round($personProperties->getAgility()->getValue() / 2), $defense->getValue());

        $shooting = $personProperties->getShooting();
        $this->assertInstanceOf(Shooting::class, $shooting);
        $this->assertSame((int)floor($personProperties->getKnack()->getValue() / 2), $shooting->getValue());

        return $personProperties;
    }

    /**
     * @param $raceStrengthModifier
     * @param $raceAgilityModifier
     * @param $raceKnackModifier
     * @param $raceWillModifier
     * @param $raceIntelligenceModifier
     * @param $raceCharismaModifier
     * @param $sizeModifier
     * @param $toughnessModifier
     * @param $sensesModifier
     * @param $weightInKg
     *
     * @return Race
     *
     */
    private function createRace(
        $raceStrengthModifier,
        $raceAgilityModifier,
        $raceKnackModifier,
        $raceWillModifier,
        $raceIntelligenceModifier,
        $raceCharismaModifier,
        $sizeModifier,
        $toughnessModifier,
        $sensesModifier,
        $weightInKg
    )
    {
        $race = \Mockery::mock(Race::class);
        $this->addGetter($race, 'getStrengthModifier', $raceStrengthModifier);
        $this->addGetter($race, 'getAgilityModifier', $raceAgilityModifier);
        $this->addGetter($race, 'getKnackModifier', $raceKnackModifier);
        $this->addGetter($race, 'getWillModifier', $raceWillModifier);
        $this->addGetter($race, 'getIntelligenceModifier', $raceIntelligenceModifier);
        $this->addGetter($race, 'getCharismaModifier', $raceCharismaModifier);
        $this->addGetter($race, 'getSizeModifier', $sizeModifier);
        $this->addGetter($race, 'getToughnessModifier', $toughnessModifier);
        $this->addGetter($race, 'getSensesModifier', $sensesModifier);
        $this->addGetter($race, 'getWeightInKg', $weightInKg);

        return $race;
    }

    /**
     * @return MockInterface|Gender
     */
    private function createGender()
    {
        $gender = \Mockery::mock(Gender::class);

        return $gender;
    }

    /**
     * @param $exceptionalStrength
     * @param $exceptionalAgility
     * @param $exceptionalKnack
     * @param $exceptionalWill
     * @param $exceptionalIntelligence
     * @param $exceptionalCharisma
     * @return MockInterface|ExceptionalityProperties
     */
    private function createExceptionalityProperties(
        $exceptionalStrength,
        $exceptionalAgility,
        $exceptionalKnack,
        $exceptionalWill,
        $exceptionalIntelligence,
        $exceptionalCharisma
    )
    {
        $exceptionalityProperties = \Mockery::mock(ExceptionalityProperties::class);

        $this->addGetter($exceptionalityProperties, 'getStrength', $strength = \Mockery::mock(Strength::class));
        $this->addGetter($strength, 'getValue', $exceptionalStrength);
        $this->addGetter($exceptionalityProperties, 'getAgility', $agility = \Mockery::mock(Agility::class));
        $this->addGetter($agility, 'getValue', $exceptionalAgility);
        $this->addGetter($exceptionalityProperties, 'getKnack', $knack = \Mockery::mock(Knack::class));
        $this->addGetter($knack, 'getValue', $exceptionalKnack);
        $this->addGetter($exceptionalityProperties, 'getWill', $will = \Mockery::mock(Will::class));
        $this->addGetter($will, 'getValue', $exceptionalWill);
        $this->addGetter($exceptionalityProperties, 'getIntelligence', $intelligence = \Mockery::mock(Intelligence::class));
        $this->addGetter($intelligence, 'getValue', $exceptionalIntelligence);
        $this->addGetter($exceptionalityProperties, 'getCharisma', $charisma = \Mockery::mock(Charisma::class));
        $this->addGetter($charisma, 'getValue', $exceptionalCharisma);

        return $exceptionalityProperties;
    }

    /**
     * @param $firstProfessionStrength
     * @param $firstProfessionAgility
     * @param $firstProfessionKnack
     * @param $firstProfessionWill
     * @param $firstProfessionIntelligence
     * @param $firstProfessionCharisma
     * @param $firstProfessionWeightModifier
     * @param $nextLevelsStrength
     * @param $nextLevelsAgility
     * @param $nextLevelsKnack
     * @param $nextLevelsWill
     * @param $nextLevelsIntelligence
     * @param $nextLevelsCharisma
     * @param $nextLevelsWeight
     * @return MockInterface|ProfessionLevels
     */
    private function createProfessionLevels(
        $firstProfessionStrength,
        $firstProfessionAgility,
        $firstProfessionKnack,
        $firstProfessionWill,
        $firstProfessionIntelligence,
        $firstProfessionCharisma,
        $firstProfessionWeightModifier,
        $nextLevelsStrength,
        $nextLevelsAgility,
        $nextLevelsKnack,
        $nextLevelsWill,
        $nextLevelsIntelligence,
        $nextLevelsCharisma,
        $nextLevelsWeight
    )
    {
        $professionLevels = \Mockery::mock(ProfessionLevels::class);

        $this->addGetter($professionLevels, 'getFirstLevel', $firstProfession = \Mockery::mock(ProfessionLevel::class));
        $this->addGetter($firstProfession, 'getProfession', \Mockery::mock(Profession::class));

        $this->addGetter($professionLevels, 'getStrengthModifierForFirstProfession', $firstProfessionStrength);
        $this->addGetter($professionLevels, 'getAgilityModifierForFirstProfession', $firstProfessionAgility);
        $this->addGetter($professionLevels, 'getKnackModifierForFirstProfession', $firstProfessionKnack);
        $this->addGetter($professionLevels, 'getWillModifierForFirstProfession', $firstProfessionWill);
        $this->addGetter($professionLevels, 'getIntelligenceModifierForFirstProfession', $firstProfessionIntelligence);
        $this->addGetter($professionLevels, 'getCharismaModifierForFirstProfession', $firstProfessionCharisma);
        $this->addGetter($professionLevels, 'getWeightKgModifierForFirstLevel', $firstProfessionWeightModifier);

        $this->addGetter($professionLevels, 'getNextLevelsStrengthModifier', $nextLevelsStrength);
        $this->addGetter($professionLevels, 'getNextLevelsAgilityModifier', $nextLevelsAgility);
        $this->addGetter($professionLevels, 'getNextLevelsKnackModifier', $nextLevelsKnack);
        $this->addGetter($professionLevels, 'getNextLevelsWillModifier', $nextLevelsWill);
        $this->addGetter($professionLevels, 'getNextLevelsIntelligenceModifier', $nextLevelsIntelligence);
        $this->addGetter($professionLevels, 'getNextLevelsCharismaModifier', $nextLevelsCharisma);
        $this->addGetter($professionLevels, 'getNextLevelsWeightModifier', $nextLevelsWeight);

        return $professionLevels;
    }

    /**
     * @param MockInterface $property
     * @param string $getterName
     * @param mixed $value
     */
    private function addGetter(MockInterface $property, $getterName = 'getValue', $value = 0)
    {
        $property->shouldReceive($getterName)
            ->atLeast()->once()
            ->andReturn($value);
    }

    /**
     * @return MockInterface|Tables
     */
    private function createTablesMock()
    {
        $tablesMock = \Mockery::mock(Tables::class);
        $tablesMock->shouldReceive('getWeightTable')
            ->atLeast()->once()
            ->andReturn($weightTable = \Mockery::mock(WeightTable::class));
        $tablesMock->shouldReceive('getWoundsTable')
            ->atLeast()->once()
            ->andReturn($fatigueTable = \Mockery::mock(WoundsTable::class));
        $fatigueTable->shouldReceive('toWounds')
            ->with(\Mockery::type('int'))
            ->atLeast()->once()
            ->andReturn(10);
        $tablesMock->shouldReceive('getFatigueTable')
            ->atLeast()->once()
            ->andReturn($fatigueTable = \Mockery::mock(FatigueTable::class));
        $fatigueTable->shouldReceive('toFatigue')
            ->with(\Mockery::type('int'))
            ->atLeast()->once()
            ->andReturn(10);

        return $tablesMock;
    }

    /**
     * @param PersonProperties $personProperties
     *
     * @test
     * @depends properties_are_calculated_properly
     */
    public function is_a_strict_object(PersonProperties $personProperties)
    {
        $this->assertInstanceOf(StrictObject::class, $personProperties);
    }

    /**
     * @test
     */
    public function exceeding_base_properties_are_limited()
    {
        $personProperties = new PersonProperties(
            $this->createRace(
                $raceStrengthModifier = 3,
                $raceAgilityModifier = 2,
                $raceKnackModifier = 1,
                $raceWillModifier = 1,
                $raceIntelligenceModifier = 1,
                $raceCharismaModifier = 1,
                $sizeModifier = 1,
                $toughnessModifier = 2,
                $sensesModifier = 3,
                $raceWeightInKgModifier = 50.0
            ),
            $this->createGender(),
            $this->createExceptionalityProperties(
                $exceptionalStrength = 4,
                $exceptionalAgility = 5,
                $exceptionalKnack = 6,
                $exceptionalWill = 7,
                $exceptionalIntelligence = 8,
                $exceptionalCharisma = 9
            ),
            $this->createProfessionLevels(
                $firstProfessionStrength = 1,
                $firstProfessionAgility = 0,
                $firstProfessionKnack = 1,
                $firstProfessionWill = 1,
                $firstProfessionIntelligence = 1,
                $firstProfessionCharisma = 1,
                $firstProfessionWeightInKg = 1.0,
                $nextLevelsStrength = 5,
                $nextLevelAgility = 8,
                $nextLevelKnack = 4,
                $nextLevelWill = 4,
                $nextLevelIntelligence = 4,
                $nextLevelCharisma = 4,
                $nextLevelsWeightInKg = 0.0
            ),
            $this->createTablesMock()
        );
        $strength = $personProperties->getStrength();
        $this->assertInstanceOf(Strength::class, $strength);
        $this->assertSame($raceStrengthModifier + min($exceptionalStrength + $firstProfessionStrength, 3) + $nextLevelsStrength, $strength->getValue());
        $this->assertSame($exceptionalStrength + $firstProfessionStrength - 3, $personProperties->getFirstLevelProperties()->getStrengthLossBecauseOfLimit());

        $agility = $personProperties->getAgility();
        $this->assertInstanceOf(Agility::class, $agility);
        $this->assertSame($raceAgilityModifier + min($exceptionalAgility + $firstProfessionAgility, 3) + $nextLevelAgility, $agility->getValue());

        $knack = $personProperties->getKnack();
        $this->assertInstanceOf(Knack::class, $knack);
        $this->assertSame($raceKnackModifier + min($exceptionalKnack + $firstProfessionKnack, 3) + $nextLevelKnack, $knack->getValue());

        $will = $personProperties->getWill();
        $this->assertInstanceOf(Will::class, $will);
        $this->assertSame($raceWillModifier + min($exceptionalWill + $firstProfessionWill, 3) + $nextLevelWill, $will->getValue());

        $intelligence = $personProperties->getIntelligence();
        $this->assertInstanceOf(Intelligence::class, $intelligence);
        $this->assertSame($raceIntelligenceModifier + min($exceptionalIntelligence + $firstProfessionIntelligence, 3) + $nextLevelIntelligence, $intelligence->getValue());

        $charisma = $personProperties->getCharisma();
        $this->assertInstanceOf(Charisma::class, $charisma);
        $this->assertSame($raceCharismaModifier + min($exceptionalCharisma + $firstProfessionCharisma, 3) + $nextLevelCharisma, $charisma->getValue());

        $weightInKg = $personProperties->getWeightInKg();
        $this->assertInstanceOf(WeightInKg::class, $weightInKg);
        $this->assertSame($raceWeightInKgModifier + $firstProfessionWeightInKg + $nextLevelsWeightInKg, $weightInKg->getValue());

        // DERIVED

        $toughness = $personProperties->getToughness();
        $this->assertInstanceOf(Toughness::class, $toughness);
        $this->assertSame($personProperties->getStrength()->getValue() + $toughnessModifier, $toughness->getValue());

        $endurance = $personProperties->getEndurance();
        $this->assertInstanceOf(Endurance::class, $endurance);
        $this->assertSame((int)round($personProperties->getStrength()->getValue() + $personProperties->getWill()->getValue()), $endurance->getValue());

        $speed = $personProperties->getSpeed();
        $this->assertInstanceOf(Speed::class, $speed);
        $this->assertSame(
            (int)(round(($personProperties->getStrength()->getValue() + $personProperties->getAgility()->getValue()) / 2)
                + (ceil($personProperties->getSize()->getValue() / 3) - 2)),
            $speed->getValue()
        );

        $size = $personProperties->getSize();
        $this->assertInstanceOf(Size::class, $size);
        $firstProfessionStrengthSummary = $firstProfessionStrength + $exceptionalStrength;
        $this->assertSame(
            $sizeModifier + ($firstProfessionStrengthSummary === 0
                ? -1
                : ($firstProfessionStrengthSummary === 1
                    ? 0
                    : 1
                )
            ),
            $size->getValue()
        );

        $senses = $personProperties->getSenses();
        $this->assertInstanceOf(Senses::class, $senses);
        $this->assertSame($personProperties->getKnack()->getValue() + $sensesModifier, $senses->getValue());

        // BATTLE

        $fight = $personProperties->getFight();
        $this->assertInstanceOf(Fight::class, $fight);

        $attack = $personProperties->getAttack();
        $this->assertInstanceOf(Attack::class, $attack);
        $this->assertSame((int)floor($personProperties->getAgility()->getValue() / 2), $attack->getValue());

        $defense = $personProperties->getDefense();
        $this->assertInstanceOf(Defense::class, $defense);
        $this->assertSame((int)round($personProperties->getAgility()->getValue() / 2), $defense->getValue());

        $shooting = $personProperties->getShooting();
        $this->assertInstanceOf(Shooting::class, $shooting);
        $this->assertSame((int)floor($personProperties->getKnack()->getValue() / 2), $shooting->getValue());

        return $personProperties;
    }

}
