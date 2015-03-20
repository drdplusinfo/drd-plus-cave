<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\ProfessionLevels\Parts;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ProfessionLevelsTest;
use DrdPlus\Cave\UnitBundle\Entity\Person;

trait ProfessionLevelsTestPersonCanBeSet
{

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return ProfessionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_null_as_person(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertNull($professionLevels->getPerson());

        return $professionLevels;
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return ProfessionLevels
     *
     * @test
     * @depends new_levels_gives_null_as_person
     */
    public function person_can_be_set(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertNull($professionLevels->getPerson());
        /** @var Person $person */
        $person = \Mockery::mock(Person::class);
        $professionLevels->setPerson($person);
        $this->assertSame($person, $professionLevels->getPerson());

        return $professionLevels;
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return ProfessionLevels
     *
     * @test
     * @depends person_can_be_set
     */
    public function same_person_can_be_set(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertInstanceOf(Person::class, $professionLevels->getPerson());
        /** @var Person|\Mockery\MockInterface $person */
        $person = $professionLevels->getPerson();
        $person->shouldReceive('getId')
            ->andReturn(123);
        $professionLevels->setPerson($person);
        $this->assertSame($person, $professionLevels->getPerson());

        return $professionLevels;
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends person_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\Exceptions\PersonIsAlreadySet
     */
    public function another_person_cause_exception(ProfessionLevels $professionLevels)
    {
        /** @var Person|\Mockery\MockInterface $previousPerson */
        $previousPerson = $professionLevels->getPerson();
        $previousPerson->shouldReceive('getId')
            ->andReturn(123);
        /** @var ProfessionLevelsTest $this */
        $this->assertInstanceOf(Person::class, $professionLevels->getPerson());
        /** @var Person|\Mockery\MockInterface $anotherPerson */
        $anotherPerson = \Mockery::mock(Person::class);
        $anotherPerson->shouldReceive('getId')
            ->andReturn(321);
        $professionLevels->setPerson($anotherPerson);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends person_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\Exceptions\PersonIsAlreadySet
     */
    public function another_person_even_without_id_cause_exception(ProfessionLevels $professionLevels)
    {
        /** @var Person|\Mockery\MockInterface $previousPerson */
        $previousPerson = $professionLevels->getPerson();
        $previousPerson->shouldReceive('getId')
            ->andReturnNull(); // no ID at all - not saved yet
        /** @var ProfessionLevelsTest $this */
        $this->assertInstanceOf(Person::class, $professionLevels->getPerson());
        /** @var Person|\Mockery\MockInterface $anotherPerson */
        $anotherPerson = \Mockery::mock(Person::class);
        $anotherPerson->shouldReceive('getId')
            ->andReturnNull(); // again not saved entity
        $professionLevels->setPerson($anotherPerson);
    }

}
