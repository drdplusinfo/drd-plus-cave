<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\Properties;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Exceptionality;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\ExceptionalityProperties;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\PersonProperties;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Race;
use DrdPlus\Cave\UnitBundle\Person\Person;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;
use Granam\Strict\Object\StrictObject;

class BasePropertiesTest extends TestWithMockery
{

    // TODO negative tests with exceeding values

    /**
     * @return PersonProperties
     *
     * @test
     */
    public function properties_are_calculated_properly()
    {
        $personProperties = new PersonProperties($this->createPersonMock(
            $raceStrengthModifier = 3, $exceptionalStrength = 2, $firstLevelStrength = 1, $nextLevelsStrength = 5,
            $raceAgilityModifier = 2, $exceptionalAgility = 3, $firstLevelAgility = 0, $nextLevelAgility = 8,
            $raceKnackModifier = 1, $exceptionalKnack = 2, $firstLevelKnack = 1, $nextLevelKnack = 4,
            $raceWillModifier = 1, $exceptionalWill = 2, $firstLevelWill = 1, $nextLevelWill = 4,
            $raceIntelligenceModifier = 1, $exceptionalIntelligence = 2, $firstLevelIntelligence = 1, $nextLevelIntelligence = 4,
            $raceCharismaModifier = 1, $exceptionalCharisma = 2, $firstLevelCharisma = 1, $nextLevelCharisma = 4,
            $sizeModifier = 1, $toughnessModifier = 2, $sensesModifier = 3
        ));
        $strength = $personProperties->getStrength();
        $this->assertInstanceOf(Strength::class, $strength);
        $this->assertSame($raceStrengthModifier + $exceptionalStrength + $firstLevelStrength + $nextLevelsStrength, $strength->getValue());

        $agility = $personProperties->getAgility();
        $this->assertInstanceOf(Agility::class, $agility);
        $this->assertSame($raceAgilityModifier + $exceptionalAgility + $firstLevelAgility + $nextLevelAgility, $agility->getValue());

        $knack = $personProperties->getKnack();
        $this->assertInstanceOf(Knack::class, $knack);
        $this->assertSame($raceKnackModifier + $exceptionalKnack + $firstLevelKnack + $nextLevelKnack, $knack->getValue());

        $will = $personProperties->getWill();
        $this->assertInstanceOf(Will::class, $will);
        $this->assertSame($raceWillModifier + $exceptionalWill + $firstLevelWill + $nextLevelWill, $will->getValue());

        $intelligence = $personProperties->getIntelligence();
        $this->assertInstanceOf(Intelligence::class, $intelligence);
        $this->assertSame($raceIntelligenceModifier + $exceptionalIntelligence + $firstLevelIntelligence + $nextLevelIntelligence, $intelligence->getValue());

        $charisma = $personProperties->getCharisma();
        $this->assertInstanceOf(Charisma::class, $charisma);
        $this->assertSame($raceCharismaModifier + $exceptionalCharisma + $firstLevelCharisma + $nextLevelCharisma, $charisma->getValue());

        // TODO add derived properties tests

        return $personProperties;
    }

    /**
     * @param $raceStrengthModifier
     * @param $exceptionalStrength
     * @param $firstLevelStrength
     * @param $nextLevelStrength
     * @param $raceAgilityModifier
     * @param $exceptionalAgility
     * @param $firstLevelAgility
     * @param $nextLevelAgility
     * @param $raceKnackModifier
     * @param $exceptionalKnack
     * @param $firstLevelKnack
     * @param $nextLevelKnack
     * @param $raceWillModifier
     * @param $exceptionalWill
     * @param $firstLevelWill
     * @param $nextLevelWill
     * @param $raceIntelligenceModifier
     * @param $exceptionalIntelligence
     * @param $firstLevelIntelligence
     * @param $nextLevelIntelligence
     * @param $raceCharismaModifier
     * @param $exceptionalCharisma
     * @param $firstLevelCharisma
     * @param $nextLevelCharisma
     * @param $sizeModifier
     * @param $toughnessModifier
     * @param $sensesModifier
     *
     * @return \Mockery\MockInterface|Person
     */
    private function createPersonMock(
        $raceStrengthModifier, $exceptionalStrength, $firstLevelStrength, $nextLevelStrength,
        $raceAgilityModifier, $exceptionalAgility, $firstLevelAgility, $nextLevelAgility,
        $raceKnackModifier, $exceptionalKnack, $firstLevelKnack, $nextLevelKnack,
        $raceWillModifier, $exceptionalWill, $firstLevelWill, $nextLevelWill,
        $raceIntelligenceModifier, $exceptionalIntelligence, $firstLevelIntelligence, $nextLevelIntelligence,
        $raceCharismaModifier, $exceptionalCharisma, $firstLevelCharisma, $nextLevelCharisma,
        $sizeModifier, $toughnessModifier, $sensesModifier
    )
    {
        $person = \Mockery::mock(Person::class);
        $person->shouldReceive('getRace')
            ->atLeast()->once()
            ->andReturn($race = \Mockery::mock(Race::class));
        $this->addGetter($race, 'getStrengthModifier', $raceStrengthModifier);
        $this->addGetter($race, 'getAgilityModifier', $raceAgilityModifier);
        $this->addGetter($race, 'getKnackModifier', $raceKnackModifier);
        $this->addGetter($race, 'getWillModifier', $raceWillModifier);
        $this->addGetter($race, 'getIntelligenceModifier', $raceIntelligenceModifier);
        $this->addGetter($race, 'getCharismaModifier', $raceCharismaModifier);
        $this->addGetter($race, 'getSizeModifier', $sizeModifier);
        $this->addGetter($race, 'getToughnessModifier', $toughnessModifier);
        $this->addGetter($race, 'getSensesModifier', $sensesModifier);

        $person->shouldReceive('getGender')
            ->atLeast()->once()
            ->andReturn($gender = \Mockery::mock(Gender::class));
        $person->shouldReceive('getExceptionality')
            ->atLeast()->once()
            ->andReturn($exceptionality = \Mockery::mock(Exceptionality::class));
        $exceptionality->shouldReceive('getExceptionalityProperties')
            ->atLeast()->once()
            ->andReturn($exceptionalityProperties = \Mockery::mock(ExceptionalityProperties::class));

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

        $person->shouldReceive('getProfessionLevels')
            ->atLeast()->once()
            ->andReturn($professionLevels = \Mockery::mock(ProfessionLevels::class));
        $this->addGetter($professionLevels, 'getStrengthModifierForFirstLevel', $firstLevelStrength);
        $this->addGetter($professionLevels, 'getAgilityModifierForFirstLevel', $firstLevelAgility);
        $this->addGetter($professionLevels, 'getKnackModifierForFirstLevel', $firstLevelKnack);
        $this->addGetter($professionLevels, 'getWillModifierForFirstLevel', $firstLevelWill);
        $this->addGetter($professionLevels, 'getIntelligenceModifierForFirstLevel', $firstLevelIntelligence);
        $this->addGetter($professionLevels, 'getCharismaModifierForFirstLevel', $firstLevelCharisma);

        $this->addGetter($professionLevels, 'getNextLevelsStrengthModifier', $nextLevelStrength);
        $this->addGetter($professionLevels, 'getNextLevelsAgilityModifier', $nextLevelAgility);
        $this->addGetter($professionLevels, 'getNextLevelsKnackModifier', $nextLevelKnack);
        $this->addGetter($professionLevels, 'getNextLevelsWillModifier', $nextLevelWill);
        $this->addGetter($professionLevels, 'getNextLevelsIntelligenceModifier', $nextLevelIntelligence);
        $this->addGetter($professionLevels, 'getNextLevelsCharismaModifier', $nextLevelCharisma);

        return $person;
    }

    /**
     * @param \Mockery\MockInterface $property
     * @param string $getterName
     * @param mixed $value
     */
    private function addGetter(\Mockery\MockInterface $property, $getterName = 'getValue', $value = 0)
    {
        $property->shouldReceive($getterName)
            ->atLeast()->once()
            ->andReturn($value);
    }

    /**
     * @param PersonProperties $baseProperties
     *
     * @test
     * @depends properties_are_calculated_properly
     */
    public function is_a_strict_object(PersonProperties $baseProperties)
    {
        $this->assertInstanceOf(StrictObject::class, $baseProperties);
    }

}
