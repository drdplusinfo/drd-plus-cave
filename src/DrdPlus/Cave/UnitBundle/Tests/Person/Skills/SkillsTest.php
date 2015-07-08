<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills;

use DrdPlus\Cave\UnitBundle\Person\Person;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Skills\Combined\CombinedSkills;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\PsychicalSkills;
use DrdPlus\Cave\UnitBundle\Person\Skills\Physical\PhysicalSkills;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

class SkillsTest extends TestWithMockery
{

    /**
     * @test
     *
     * @return Skills
     */
    public function can_create_instance()
    {
        $instance = new Skills($this->createProfessionFirstLevel());
        $this->assertNotNull($instance);
        $this->assertInstanceOf(CombinedSkills::class, $instance->getCombinedSkills());
        $this->assertInstanceOf(PhysicalSkills::class, $instance->getPhysicalSkills());
        $this->assertInstanceOf(PsychicalSkills::class, $instance->getPsychicalSkills());
        $this->assertNull($instance->getPerson());

        return $instance;
    }

    /**
     * @return \Mockery\MockInterface|ProfessionLevel
     */
    private function createProfessionFirstLevel()
    {
        $professionFirstLevel = $this->mockery(ProfessionLevel::class);
        $professionFirstLevel->shouldReceive('isFirstLevel')
            ->atLeast()->once()
            ->andReturn(true);

        return $professionFirstLevel;
    }

    /* PERSON */

    /**
     * @param Skills $skills
     *
     * @return Skills
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_null_as_person(Skills $skills)
    {
        $this->assertNull($skills->getPerson());

        return $skills;
    }

    /**
     * @param Skills $skills
     *
     * @return Skills
     *
     * @test
     * @depends new_levels_gives_null_as_person
     */
    public function person_can_be_set(Skills $skills)
    {
        $this->assertNull($skills->getPerson());
        /** @var Person|\Mockery\MockInterface $person */
        $person = \Mockery::mock(Person::class);
        $person->shouldReceive('getProfessionLevels')
            ->atLeast()->once()
            ->andReturn($skills);
        $skills->setPerson($person);
        $this->assertSame($person, $skills->getPerson());

        return $skills;
    }

    /**
     * @param Skills $skills
     *
     * @return Skills
     *
     * @test
     * @depends person_can_be_set
     */
    public function same_person_can_be_set(Skills $skills)
    {
        $this->assertInstanceOf(Person::class, $skills->getPerson());
        /** @var Person|\Mockery\MockInterface $person */
        $person = $skills->getPerson();
        $person->shouldReceive('getId')
            ->andReturn(123);
        $skills->setPerson($person);
        $this->assertSame($person, $skills->getPerson());

        return $skills;
    }

    /**
     * @param Skills $skills
     *
     * @test
     * @depends person_can_be_set
     * @expectedException \LogicException
     */
    public function another_person_cause_exception(Skills $skills)
    {
        /** @var Person|\Mockery\MockInterface $previousPerson */
        $previousPerson = $skills->getPerson();
        $previousPerson->shouldReceive('getId')
            ->andReturn(123);
        $this->assertInstanceOf(Person::class, $skills->getPerson());
        /** @var Person|\Mockery\MockInterface $anotherPerson */
        $anotherPerson = \Mockery::mock(Person::class);
        $anotherPerson->shouldReceive('getId')
            ->andReturn(321);
        $anotherPerson->shouldReceive('getProfessionLevels')
            ->andReturn($skills);
        $skills->setPerson($anotherPerson);
    }

    /**
     * @param Skills $skills
     *
     * @test
     * @depends person_can_be_set
     * @expectedException \LogicException
     */
    public function another_person_even_without_id_cause_exception(Skills $skills)
    {
        /** @var Person|\Mockery\MockInterface $previousPerson */
        $previousPerson = $skills->getPerson();
        $previousPerson->shouldReceive('getId')
            ->andReturnNull(); // no ID at all - not saved yet
        $this->assertInstanceOf(Person::class, $skills->getPerson());
        /** @var Person|\Mockery\MockInterface $anotherPerson */
        $anotherPerson = \Mockery::mock(Person::class);
        $anotherPerson->shouldReceive('getId')
            ->andReturnNull(); // again not saved entity
        $anotherPerson->shouldReceive('getProfessionLevels')
            ->andReturn($skills);
        $skills->setPerson($anotherPerson);
    }

}
