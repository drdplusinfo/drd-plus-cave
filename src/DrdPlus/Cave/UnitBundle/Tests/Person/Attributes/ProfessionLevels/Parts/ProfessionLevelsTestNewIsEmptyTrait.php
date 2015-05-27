<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\ProfessionLevels\Parts;

use Doctrine\Common\Collections\ArrayCollection;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevelsTest;

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