<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\ProfessionLevels\Parts;

use Doctrine\Common\Collections\ArrayCollection;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ProfessionLevelsTest;
use DrdPlus\Cave\UnitBundle\Entity\Person;

trait ProfessionLevelsTestNewIsEmptyTrait
{

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_first_level_strength_increment(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getStrengthFirstLevelIncrement());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_strength_increment_summary(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getStrengthIncrementSummary());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_first_level_agility_increment(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getAgilityFirstLevelIncrement());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_agility_increment_summary(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getAgilityIncrementSummary());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_first_level_knack_increment(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getKnackFirstLevelIncrement());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_knack_increment_summary(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getKnackIncrementSummary());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_first_level_will_increment(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getWillFirstLevelIncrement());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_will_increment_summary(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getWillIncrementSummary());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_first_level_intelligence_increment(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getIntelligenceFirstLevelIncrement());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_intelligence_increment_summary(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getIntelligenceIncrementSummary());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_first_level_charisma_increment(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getCharismaFirstLevelIncrement());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_charisma_increment_summary(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getCharismaIncrementSummary());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_empty_array_as_levels(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame([], $professionLevels->getLevels());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_false_as_first_level(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertFalse($professionLevels->getFirstLevel());
    }

    /**
     * @param ProfessionLevels $professionLevels
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

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_empty_array_collection_as_fighter_levels(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $levels = $professionLevels->getFighterLevels();
        $this->assertInstanceOf(ArrayCollection::class, $levels);
        $this->isEmpty($levels->toArray());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_empty_array_collection_as_priest_levels(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $levels = $professionLevels->getPriestLevels();
        $this->assertInstanceOf(ArrayCollection::class, $levels);
        $this->isEmpty($levels->toArray());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_empty_array_collection_as_ranger_levels(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $levels = $professionLevels->getRangerLevels();
        $this->assertInstanceOf(ArrayCollection::class, $levels);
        $this->isEmpty($levels->toArray());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_empty_array_collection_as_theurgist_levels(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $levels = $professionLevels->getTheurgistLevels();
        $this->assertInstanceOf(ArrayCollection::class, $levels);
        $this->isEmpty($levels->toArray());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_empty_array_collection_as_thief_levels(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $levels = $professionLevels->getThiefLevels();
        $this->assertInstanceOf(ArrayCollection::class, $levels);
        $this->isEmpty($levels->toArray());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_empty_array_collection_as_wizard_levels(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $levels = $professionLevels->getWizardLevels();
        $this->assertInstanceOf(ArrayCollection::class, $levels);
        $this->isEmpty($levels->toArray());
    }

}
