<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\Properties;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Exceptionality;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\ExceptionalityProperties;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\PersonProperties;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
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
            $raceStrengthModifier = 3, $exceptionalStrength = 2, $firstLevelStrength = 1,
            $raceAgilityModifier = 2, $exceptionalAgility = 3, $firstLevelAgility = 0,
            $raceKnackModifier = 1, $exceptionalKnack = 2, $firstLevelKnack = 1
            // TODO other properties
        ));
        $strength = $personProperties->getStrength();
        $this->assertInstanceOf(Strength::class, $strength);
        $this->assertSame($raceStrengthModifier + $exceptionalStrength + $firstLevelStrength, $strength->getValue());

        $agility = $personProperties->getAgility();
        $this->assertInstanceOf(Agility::class, $agility);
        $this->assertSame($raceAgilityModifier + $exceptionalAgility + $firstLevelAgility, $agility->getValue());

        $knack = $personProperties->getKnack();
        $this->assertInstanceOf(Knack::class, $knack);
        $this->assertSame($raceKnackModifier + $exceptionalKnack + $firstLevelKnack, $knack->getValue());

        return $personProperties;
    }

    /**
     * @return \Mockery\MockInterface|Person
     */
    private function createPersonMock(
        $raceStrengthModifier, $exceptionalStrength, $firstLevelStrength,
        $raceAgilityModifier, $exceptionalAgility, $firstLevelAgility,
        $raceKnackModifier, $exceptionalKnack, $firstLevelKnack
    )
    {
        $person = \Mockery::mock(Person::class);
        $person->shouldReceive('getRace')
            ->atLeast()->once()
            ->andReturn($race = \Mockery::mock(Race::class));
        $this->addGetter($race, 'getStrengthModifier', $raceStrengthModifier);
        $this->addGetter($race, 'getAgilityModifier', $raceAgilityModifier);
        $this->addGetter($race, 'getKnackModifier', $raceKnackModifier);
        $this->addGetter($race, 'getWillModifier');
        $this->addGetter($race, 'getIntelligenceModifier');
        $this->addGetter($race, 'getCharismaModifier');
        $this->addGetter($race, 'getSizeModifier');
        $this->addGetter($race, 'getToughnessModifier');
        $this->addGetter($race, 'getSensesModifier');

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
        $this->addGetter($will);
        $this->addGetter($exceptionalityProperties, 'getIntelligence', $intelligence = \Mockery::mock(Intelligence::class));
        $this->addGetter($intelligence);
        $this->addGetter($exceptionalityProperties, 'getCharisma', $charisma = \Mockery::mock(Charisma::class));
        $this->addGetter($charisma);

        $person->shouldReceive('getProfessionLevels')
            ->atLeast()->once()
            ->andReturn($professionLevels = \Mockery::mock(ProfessionLevels::class));
        $this->addGetter($professionLevels, 'getStrengthModifierForFirstLevel', $firstLevelStrength);
        $this->addGetter($professionLevels, 'getAgilityModifierForFirstLevel', $firstLevelAgility);
        $this->addGetter($professionLevels, 'getKnackModifierForFirstLevel', $firstLevelKnack);
        $this->addGetter($professionLevels, 'getWillModifierForFirstLevel');
        $this->addGetter($professionLevels, 'getIntelligenceModifierForFirstLevel');
        $this->addGetter($professionLevels, 'getCharismaModifierForFirstLevel');
        $this->addGetter($professionLevels, 'getLevels', []);

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
