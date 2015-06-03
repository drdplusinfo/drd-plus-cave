<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\ProfessionLevels\Parts;

use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\FighterLevel;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\LevelValue;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevelsTest;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;

trait ProfessionLevelsTestMoreLevelsTrait
{

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return ProfessionLevels
     *
     * @test
     * @depends fighter_level_can_be_added
     */
    public function more_fighter_levels_can_be_added(ProfessionLevels $professionLevels)
    {
        return $this->moreLevelsCanBeAdded('fighter', $professionLevels);
    }

    private function moreLevelsCanBeAdded(
        $professionName,
        ProfessionLevels $professionLevels
    )
    {
        /** @var ProfessionLevelsTest|ProfessionLevelsTestMoreLevelsTrait $this */
        /** @var FighterLevel|\Mockery\MockInterface $firstLevel */
        $firstLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf($this->getMoreLevelsProfessionLevelClass($professionName), $firstLevel);
        $this->assertSame(1, count($professionLevels->getLevels()));

        /** @var LevelValue|\Mockery\MockInterface $firstLevelValue */
        $firstLevelValue = $firstLevel->getLevelValue();
        $firstLevelValue->shouldReceive('getValue')
            ->andReturn(1);
        /** @var FighterLevel|\Mockery\MockInterface $anotherLevel */
        $anotherLevel = \Mockery::mock($this->getMoreLevelsProfessionLevelClass($professionName));
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn($professionName);
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getValue')
            ->andReturn(2);

        $adder = 'add' . ucfirst($professionName) . 'Level';
        $professionLevels->$adder($anotherLevel);

        $this->assertSame($firstLevel, $professionLevels->getFirstLevel());
        $levelsGetter = 'get' . ucfirst($professionName) . 'Levels';
        $this->assertSame([$firstLevel, $anotherLevel], $professionLevels->$levelsGetter()->toArray());
        $this->assertSame([$firstLevel, $anotherLevel], $professionLevels->getLevels());

        return $professionLevels;
    }

    private function getMoreLevelsProfessionLevelClass($professionName)
    {
        return '\DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\\'
        . ucfirst($professionName) . 'Level';
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends fighter_level_can_be_added
     */
    public function fighter_has_strength_increment_summary_as_expected(ProfessionLevels $professionLevels)
    {
        $this->professionHasPropertyIncrementSummaryAsExpected('fighter', 'strength', $professionLevels);
    }

    public function professionHasPropertyIncrementSummaryAsExpected(
        $professionName,
        $testedProperty,
        ProfessionLevels $professionLevels
    )
    {
        $propertySummary = 0;
        foreach ($professionLevels->getLevels() as $level) {
            /** @var ProfessionLevel|\Mockery\MockInterface $level */
            $level->shouldReceive('get' . ucfirst($testedProperty) . 'Increment')
                ->andReturn($propertyIncrement = \Mockery::mock(Strength::class));
            $propertyIncrement->shouldReceive('getValue')
                ->andReturn($property = 123);
            $propertySummary += $property;
        }
        /** @var ProfessionLevelsTest|ProfessionLevelsTestMoreLevelsTrait $this */
        $this->assertSame(
            (in_array($testedProperty, $this->getMoreLevelsPrimaryPropertiesToProfession($professionName))
                ? 1
                : 0
            )
            + $propertySummary, $professionLevels->getStrengthIncrementSummary()
        );
    }

    private function getMoreLevelsPrimaryPropertiesToProfession($professionName)
    {
        switch ($professionName) {
            case 'fighter' :
                return ['strength', 'agility'];
            case 'priest' :
                return ['will', 'charisma'];
            case 'ranger' :
                return ['strength', 'knack'];
            case 'theurgist' :
                return ['intelligence', 'charisma'];
            case 'thief' :
                return ['knack', 'agility'];
            case 'wizard' :
                return ['will', 'intelligence'];
            default :
                throw new \RuntimeException("Unknown profession name " . var_export($professionName, true));
        }
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends fighter_level_can_be_added
     */
    public function fighter_has_agility_increment_summary_as_expected(ProfessionLevels $professionLevels)
    {
        $this->professionHasPropertyIncrementSummaryAsExpected('fighter', 'agility', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_fighter_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_fighter_level_with_occupied_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithOccupiedSequenceCauseException('fighter', $professionLevels);
    }

    private function addingLevelWithOccupiedSequenceCauseException(
        $professionName,
        ProfessionLevels $professionLevels
    )
    {
        /** @var ProfessionLevelsTest|ProfessionLevelsTestMoreLevelsTrait $this */
        $this->assertSame(2, count($professionLevels->getLevels()));
        /** @var FighterLevel|\Mockery\MockInterface $anotherLevel */

        $anotherLevel = \Mockery::mock($this->getMoreLevelsProfessionLevelClass($professionName));
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn($professionName);
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getValue')
            ->andReturn(2 /* already occupied level tank */);

        $adder = 'add' . ucfirst($professionName) . 'Level';
        $professionLevels->$adder($anotherLevel);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_fighter_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_fighter_level_with_too_high_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithTooHighSequenceCauseException('fighter', $professionLevels);
    }

    private function addingLevelWithTooHighSequenceCauseException(
        $professionName,
        ProfessionLevels $professionLevels
    )
    {
        /** @var ProfessionLevelsTest|ProfessionLevelsTestMoreLevelsTrait $this */
        $this->assertSame(2, count($professionLevels->getLevels()));

        /** @var FighterLevel|\Mockery\MockInterface $anotherLevel */
        $anotherLevel = \Mockery::mock($this->getMoreLevelsProfessionLevelClass($professionName));
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn($professionName);
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getValue')
            ->andReturn(4 /* skipped rank 3 */);

        $adder = 'add' . ucfirst($professionName) . 'Level';
        $professionLevels->$adder($anotherLevel);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_fighter_levels_can_be_added
     * @expectedException \LogicException
     */
    public function changed_fighter_level_during_usage_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->changedLevelDuringUsageCauseException('fighter', $professionLevels);
    }

    private function changedLevelDuringUsageCauseException(
        $professionName,
        ProfessionLevels $professionLevels
    )
    {
        /** @var ProfessionLevelsTest|ProfessionLevelsTestMoreLevelsTrait $this */
        $this->assertSame(2, count($professionLevels->getLevels()));
        /** @var FighterLevel|\Mockery\MockInterface $anotherLevel */
        $anotherLevel = \Mockery::mock($this->getMoreLevelsProfessionLevelClass($professionName));
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn('fighter');
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $rank = 3;
        $anotherLevelValue->shouldReceive('getValue')
            ->andReturnUsing($rankGetter = function () use (&$rank) {
                return $rank;
            });

        $adder = 'add' . ucfirst($professionName) . 'Level';
        $professionLevels->$adder($anotherLevel);
        /** @noinspection PhpUnusedLocalVariableInspection */
        $rank = 1; // changed rank to already occupied value

        $professionLevels->getFirstLevel();
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return ProfessionLevels
     *
     * @test
     * @depends priest_level_can_be_added
     */
    public function more_priest_levels_can_be_added(ProfessionLevels $professionLevels)
    {
        return $this->moreLevelsCanBeAdded('priest', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_priest_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_priest_level_with_occupied_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithOccupiedSequenceCauseException('priest', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_priest_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_priest_level_with_too_high_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithTooHighSequenceCauseException('priest', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_priest_levels_can_be_added
     * @expectedException \LogicException
     */
    public function changed_priest_level_during_usage_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->changedLevelDuringUsageCauseException('priest', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return ProfessionLevels
     *
     * @test
     * @depends ranger_level_can_be_added
     */
    public function more_ranger_levels_can_be_added(ProfessionLevels $professionLevels)
    {
        return $this->moreLevelsCanBeAdded('ranger', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_ranger_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_ranger_level_with_occupied_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithOccupiedSequenceCauseException('ranger', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_ranger_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_ranger_level_with_too_high_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithTooHighSequenceCauseException('ranger', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_ranger_levels_can_be_added
     * @expectedException \LogicException
     */
    public function changed_ranger_level_during_usage_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->changedLevelDuringUsageCauseException('ranger', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return ProfessionLevels
     *
     * @test
     * @depends theurgist_level_can_be_added
     */
    public function more_theurgist_levels_can_be_added(ProfessionLevels $professionLevels)
    {
        return $this->moreLevelsCanBeAdded('theurgist', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_theurgist_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_theurgist_level_with_occupied_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithOccupiedSequenceCauseException('theurgist', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_theurgist_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_theurgist_level_with_too_high_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithTooHighSequenceCauseException('theurgist', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_theurgist_levels_can_be_added
     * @expectedException \LogicException
     */
    public function changed_theurgist_level_during_usage_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->changedLevelDuringUsageCauseException('theurgist', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return ProfessionLevels
     *
     * @test
     * @depends thief_level_can_be_added
     */
    public function more_thief_levels_can_be_added(ProfessionLevels $professionLevels)
    {
        return $this->moreLevelsCanBeAdded('thief', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_thief_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_thief_level_with_occupied_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithOccupiedSequenceCauseException('thief', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_thief_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_thief_level_with_too_high_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithTooHighSequenceCauseException('thief', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_thief_levels_can_be_added
     * @expectedException \LogicException
     */
    public function changed_thief_level_during_usage_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->changedLevelDuringUsageCauseException('thief', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return ProfessionLevels
     *
     * @test
     * @depends wizard_level_can_be_added
     */
    public function more_wizard_levels_can_be_added(ProfessionLevels $professionLevels)
    {
        return $this->moreLevelsCanBeAdded('wizard', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_wizard_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_wizard_level_with_occupied_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithOccupiedSequenceCauseException('wizard', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_wizard_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_wizard_level_with_too_high_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithTooHighSequenceCauseException('wizard', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_wizard_levels_can_be_added
     * @expectedException \LogicException
     */
    public function changed_wizard_level_during_usage_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->changedLevelDuringUsageCauseException('wizard', $professionLevels);
    }

}
