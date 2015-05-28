<?php
namespace DrdPlus\Cave\UnitBundle\Person;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Exceptionality;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Name;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\BaseProperties;
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
            $this->getBasePropertiesMock(),
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
            $this->getBasePropertiesMock(),
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
            $this->getBasePropertiesMock(),
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
            $this->getBasePropertiesMock(),
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
            $this->getBasePropertiesMock(),
            $this->getProfessionLevelsMock()
        );
        $this->assertSame($exceptionality, $person->getExceptionality());
    }

    /** @test */
    public function returns_same_base_properties_as_got()
    {
        $person = new Person(
            $this->getRaceMock(),
            $this->getGenderMock(),
            $this->getNameMock(),
            $this->getExceptionalityMock(),
            $baseProperties = $this->getBasePropertiesMock(),
            $this->getProfessionLevelsMock()
        );
        $this->assertSame($baseProperties, $person->getBaseProperties());
    }

    /** @test */
    public function returns_same_profession_levels_as_got()
    {
        $person = new Person(
            $this->getRaceMock(),
            $this->getGenderMock(),
            $this->getNameMock(),
            $this->getExceptionalityMock(),
            $this->getBasePropertiesMock(),
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
            $this->getBasePropertiesMock(),
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
            $this->getBasePropertiesMock(),
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
        $exceptionality = \Mockery::mock(Exceptionality::class);
        $exceptionality->shouldReceive('setPerson')
            ->with(\Mockery::type(Person::class))
            ->once();

        return $exceptionality;
    }

    /**
     * @return BaseProperties
     */
    private function getBasePropertiesMock()
    {
        $baseProperties = \Mockery::mock(BaseProperties::class);
        $baseProperties->shouldReceive('setPerson')
            ->with(\Mockery::type(Person::class))
            ->once();

        return $baseProperties;
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
