<?php
namespace DrdPlus\Cave\UnitBundle\Person;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Exceptionality;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\ExceptionalityProperties;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Name;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Race;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

class PersonTest extends TestWithMockery
{

    /** @test */
    public function can_create_instance()
    {
        $instance = new Person(
            $this->getRaceMock(),
            $this->getGenderMock(),
            $this->getNameMock(),
            $this->getExceptionalityMock(),
            $this->getProfessionLevelsMock()
        );
        $this->assertNotNull($instance);
    }

    /** @test */
    public function base_id_is_null()
    {
        $person = new Person(
            $this->getRaceMock(),
            $this->getGenderMock(),
            $this->getNameMock(),
            $this->getExceptionalityMock(),
            $this->getProfessionLevelsMock()
        );
        $this->assertNull($person->getId());
    }

    /** @test */
    public function returns_same_race_as_got()
    {
        $person = new Person(
            $race = $this->getRaceMock(),
            $this->getGenderMock(),
            $this->getNameMock(),
            $this->getExceptionalityMock(),
            $this->getProfessionLevelsMock()
        );
        $this->assertSame($race, $person->getRace());
    }

    /** @test */
    public function returns_same_gender_as_got()
    {
        $person = new Person(
            $this->getRaceMock(),
            $gender = $this->getGenderMock(),
            $this->getNameMock(),
            $this->getExceptionalityMock(),
            $this->getProfessionLevelsMock()
        );
        $this->assertSame($gender, $person->getGender());
    }

    /** @test */
    public function returns_same_exceptionality_as_got()
    {
        $person = new Person(
            $this->getRaceMock(),
            $this->getGenderMock(),
            $this->getNameMock(),
            $exceptionality = $this->getExceptionalityMock(),
            $this->getProfessionLevelsMock()
        );
        $this->assertSame($exceptionality, $person->getExceptionality());
    }

    /** @test */
    public function returns_same_profession_levels_as_got()
    {
        $person = new Person(
            $this->getRaceMock(),
            $this->getGenderMock(),
            $this->getNameMock(),
            $this->getExceptionalityMock(),
            $professionLevels = $this->getProfessionLevelsMock()
        );
        $this->assertSame($professionLevels, $person->getProfessionLevels());
    }

    /** @test */
    public function returns_same_name_as_got()
    {
        $person = new Person(
            $this->getRaceMock(),
            $this->getGenderMock(),
            $name = $this->getNameMock(),
            $this->getExceptionalityMock(),
            $this->getProfessionLevelsMock()
        );
        $this->assertSame($name, $person->getName());
    }

    /** @test */
    public function can_change_name()
    {
        $person = new Person(
            $this->getRaceMock(),
            $this->getGenderMock(),
            $this->getNameMock(),
            $this->getExceptionalityMock(),
            $this->getProfessionLevelsMock()
        );
        Name::registerSelf();
        $person->setName($name = Name::getEnum($nameString = 'foo'));
        $this->assertSame($name, $person->getName());
        $this->assertSame($nameString, (string)$person->getName());
        $person->setName($newName = Name::getEnum($newNameString = 'bar'));
        $this->assertSame($newName, $person->getName());
        $this->assertSame($newNameString, (string)$person->getName());
    }

    /**
     * @return Race
     */
    private function getRaceMock()
    {
        $race = \Mockery::mock(Race::class);
        $race->shouldReceive('getStrengthModifier')
            ->once()
            ->andReturn(0);
        $race->shouldReceive('getAgilityModifier')
            ->once()
            ->andReturn(0);
        $race->shouldReceive('getKnackModifier')
            ->once()
            ->andReturn(0);
        $race->shouldReceive('getWillModifier')
            ->once()
            ->andReturn(0);
        $race->shouldReceive('getIntelligenceModifier')
            ->once()
            ->andReturn(0);
        $race->shouldReceive('getCharismaModifier')
            ->once()
            ->andReturn(0);
        $race->shouldReceive('getToughnessModifier')
            ->once()
            ->andReturn(0);
        $race->shouldReceive('getSizeModifier')
            ->once()
            ->andReturn(0);
        $race->shouldReceive('getSensesModifier')
            ->once()
            ->andReturn(0);

        return $race;
    }

    /**
     * @return Gender
     */
    private function getGenderMock()
    {
        return \Mockery::mock(Gender::class);
    }

    /**
     * @return Exceptionality
     */
    private function getExceptionalityMock()
    {
        $exceptionality = \Mockery::mock(Exceptionality::class);
        $exceptionality->shouldReceive('setPerson')
            ->with(\Mockery::type(Person::class))
            ->once();
        $exceptionality->shouldReceive('getExceptionalityProperties')
            ->once()
            ->andReturn($exceptionalityProperties = \Mockery::mock(ExceptionalityProperties::class));
        $exceptionalityProperties->shouldReceive('getStrength')
            ->once()
            ->andReturn($strength = \Mockery::mock(Strength::class));
        $strength->shouldReceive('getValue')
            ->andReturn(0);
        $exceptionalityProperties->shouldReceive('getAgility')
            ->once()
            ->andReturn($agility = \Mockery::mock(Agility::class));
        $agility->shouldReceive('getValue')
            ->andReturn(0);
        $exceptionalityProperties->shouldReceive('getKnack')
            ->once()
            ->andReturn($knack = \Mockery::mock(Knack::class));
        $knack->shouldReceive('getValue')
            ->andReturn(0);
        $exceptionalityProperties->shouldReceive('getWill')
            ->once()
            ->andReturn($will = \Mockery::mock(Will::class));
        $will->shouldReceive('getValue')
            ->andReturn(0);
        $exceptionalityProperties->shouldReceive('getIntelligence')
            ->once()
            ->andReturn($intelligence = \Mockery::mock(Intelligence::class));
        $intelligence->shouldReceive('getValue')
            ->andReturn(0);
        $exceptionalityProperties->shouldReceive('getCharisma')
            ->once()
            ->andReturn($charisma = \Mockery::mock(Charisma::class));
        $charisma->shouldReceive('getValue')
            ->andReturn(0);

        return $exceptionality;
    }

    /**
     * @return ProfessionLevels
     */
    private function getProfessionLevelsMock()
    {
        $professionLevels = \Mockery::mock(ProfessionLevels::class);
        $professionLevels->shouldReceive('setPerson')
            ->with(\Mockery::type(Person::class))
            ->once();
        $professionLevels->shouldReceive('getStrengthFirstLevelIncrement')
            ->once()
            ->andReturn(0);
        $professionLevels->shouldReceive('getAgilityFirstLevelIncrement')
            ->once()
            ->andReturn(0);
        $professionLevels->shouldReceive('getAgilityIncrementSummary')
            ->once()
            ->andReturn(0);
        $professionLevels->shouldReceive('getKnackFirstLevelIncrement')
            ->once()
            ->andReturn(0);
        $professionLevels->shouldReceive('getWillFirstLevelIncrement')
            ->once()
            ->andReturn(0);
        $professionLevels->shouldReceive('getIntelligenceFirstLevelIncrement')
            ->once()
            ->andReturn(0);
        $professionLevels->shouldReceive('getCharismaFirstLevelIncrement')
            ->once()
            ->andReturn(0);


        return $professionLevels;
    }

    /**
     * @return Name
     */
    private function getNameMock()
    {
        return \Mockery::mock(Name::class);
    }
}
