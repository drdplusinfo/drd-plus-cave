<?php
namespace DrdPlus\Cave\UnitBundle\Entity;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Exceptionality;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Name;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\InitialProperties;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Race;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

class PersonTest extends TestWithMockery
{

    /** @test */
    public function can_create_instance()
    {
        $instance = new Person(
            $this->getRaceMock(),
            $this->getGenderMock(),
            $this->getExceptionalityMock(),
            $this->getInitialPropertiesMock(),
            $this->getProfessionLevelsMock(),
            $this->getNameMock()
        );
        $this->assertNotNull($instance);
    }

    /** @test */
    public function initial_id_is_null()
    {
        $person = new Person(
            $this->getRaceMock(),
            $this->getGenderMock(),
            $this->getExceptionalityMock(),
            $this->getInitialPropertiesMock(),
            $this->getProfessionLevelsMock(),
            $this->getNameMock()
        );
        $this->assertNull($person->getId());
    }

    /** @test */
    public function returns_same_race_as_got()
    {
        $person = new Person(
            $race = $this->getRaceMock(),
            $this->getGenderMock(),
            $this->getExceptionalityMock(),
            $this->getInitialPropertiesMock(),
            $this->getProfessionLevelsMock(),
            $this->getNameMock()
        );
        $this->assertSame($race, $person->getRace());
    }

    /** @test */
    public function returns_same_gender_as_got()
    {
        $person = new Person(
            $this->getRaceMock(),
            $gender = $this->getGenderMock(),
            $this->getExceptionalityMock(),
            $this->getInitialPropertiesMock(),
            $this->getProfessionLevelsMock(),
            $this->getNameMock()
        );
        $this->assertSame($gender, $person->getGender());
    }

    /** @test */
    public function returns_same_exceptionality_as_got()
    {
        $person = new Person(
            $this->getRaceMock(),
            $this->getGenderMock(),
            $exceptionality = $this->getExceptionalityMock(),
            $this->getInitialPropertiesMock(),
            $this->getProfessionLevelsMock(),
            $this->getNameMock()
        );
        $this->assertSame($exceptionality, $person->getExceptionality());
    }

    /** @test */
    public function returns_same_initial_properties_as_got()
    {
        $person = new Person(
            $this->getRaceMock(),
            $this->getGenderMock(),
            $this->getExceptionalityMock(),
            $initialProperties = $this->getInitialPropertiesMock(),
            $this->getProfessionLevelsMock(),
            $this->getNameMock()
        );
        $this->assertSame($initialProperties, $person->getInitialProperties());
    }

    /** @test */
    public function returns_same_profession_levels_as_got()
    {
        $person = new Person(
            $this->getRaceMock(),
            $this->getGenderMock(),
            $this->getExceptionalityMock(),
            $this->getInitialPropertiesMock(),
            $professionLevels = $this->getProfessionLevelsMock(),
            $this->getNameMock()
        );
        $this->assertSame($professionLevels, $person->getProfessionLevels());
    }

    /** @test */
    public function returns_same_name_as_got()
    {
        $person = new Person(
            $this->getRaceMock(),
            $this->getGenderMock(),
            $this->getExceptionalityMock(),
            $this->getInitialPropertiesMock(),
            $this->getProfessionLevelsMock(),
            $name = $this->getNameMock()
        );
        $this->assertSame($name, $person->getName());
    }

    /** @test */
    public function can_change_name()
    {
        $person = new Person(
            $this->getRaceMock(),
            $this->getGenderMock(),
            $this->getExceptionalityMock(),
            $this->getInitialPropertiesMock(),
            $this->getProfessionLevelsMock(),
            $this->getNameMock()
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
        return \Mockery::mock(Race::class);
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
        return \Mockery::mock(Exceptionality::class);
    }

    /**
     * @return InitialProperties
     */
    private function getInitialPropertiesMock()
    {
        $initialProperties = \Mockery::mock(InitialProperties::class);
        $initialProperties->shouldReceive('setPerson')
            ->with(\Mockery::type(Person::class))
            ->atLeast()->once();

        return $initialProperties;
    }

    /**
     * @return ProfessionLevels
     */
    private function getProfessionLevelsMock()
    {
        $professionLevels = \Mockery::mock(ProfessionLevels::class);
        $professionLevels->shouldReceive('setPerson')
            ->with(\Mockery::type(Person::class))
            ->atLeast()->once();

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
