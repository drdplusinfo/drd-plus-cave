<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Entity;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\InitialProperties;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Name;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Race;
use DrdPlus\Cave\UnitBundle\Entity\Person;

class PersonTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function can_create_instance()
    {
        $instance = new Person($this->getGenderMock(), $this->getRaceMock(), $this->getInitialPropertiesMock(), $this->getProfessionLevelsMock());
        $this->assertNotNull($instance);
    }

    /** @test */
    public function initial_id_is_null()
    {
        $person = new Person($this->getGenderMock(), $this->getRaceMock(), $this->getInitialPropertiesMock(), $this->getProfessionLevelsMock());
        $this->assertNull($person->getId());
    }

    /** @test */
    public function returns_same_gender_as_got()
    {
        $gender = $this->getGenderMock();
        $person = new Person($gender, $this->getRaceMock(), $this->getInitialPropertiesMock(), $this->getProfessionLevelsMock());
        $this->assertSame($gender, $person->getGender());
    }

    /** @test */
    public function returns_same_race_as_got()
    {
        $race = $this->getRaceMock();
        $person = new Person($this->getGenderMock(), $race, $this->getInitialPropertiesMock(), $this->getProfessionLevelsMock());
        $this->assertSame($race, $person->getRace());
    }

    /** @test */
    public function returns_same_initial_properties_as_got()
    {
        $initialProperties = $this->getInitialPropertiesMock();
        $person = new Person($this->getGenderMock(), $this->getRaceMock(), $initialProperties, $this->getProfessionLevelsMock());
        $this->assertSame($initialProperties, $person->getInitialProperties());
    }

    /** @test */
    public function returns_same_profession_levels_as_got()
    {
        $professionLevels = $this->getProfessionLevelsMock();
        $person = new Person($this->getGenderMock(), $this->getRaceMock(), $this->getInitialPropertiesMock(), $professionLevels);
        $this->assertSame($professionLevels, $person->getProfessionLevels());
    }

    /** @test */
    public function default_name_is_empty_name_enum()
    {
        $person = new Person($this->getGenderMock(), $this->getRaceMock(), $this->getInitialPropertiesMock(), $this->getProfessionLevelsMock());
        $defaultName = $person->getName();
        $this->assertInstanceOf(Name::class, $defaultName);
        $this->assertSame('', (string)$defaultName);
    }

    /** @test */
    public function can_change_name()
    {
        $person = new Person($this->getGenderMock(), $this->getRaceMock(), $this->getInitialPropertiesMock(), $this->getProfessionLevelsMock());
        $person->setName($name = Name::get('foo'));
        $this->assertSame($name, $person->getName());
        $person->setName($newName = Name::get('bar'));
        $this->assertSame($newName, $person->getName());
    }

    /**
     * @return Gender
     */
    private function getGenderMock()
    {
        return \Mockery::mock(Gender::class);
    }

    /**
     * @return Race
     */
    private function getRaceMock()
    {
        return \Mockery::mock(Race::class);
    }

    /**
     * @return InitialProperties
     */
    private function getInitialPropertiesMock()
    {
        return \Mockery::mock(InitialProperties::class);
    }

    /**
     * @return ProfessionLevels
     */
    private function getProfessionLevelsMock()
    {
        return \Mockery::mock(ProfessionLevels::class);
    }
}
