<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\ProfessionLevels\Parts;

use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\FighterLevel;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\LevelValue;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevelsTest;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Professions\Fighter;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Professions\Priest;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Professions\Profession;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Professions\Ranger;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Professions\Theurgist;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Professions\Thief;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Professions\Wizard;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\BaseProperty;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;

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
        $professionLevels = $this->moreLevelsCanBeAdded(Fighter::FIGHTER, $professionLevels);

        return $professionLevels;
    }

    private function moreLevelsCanBeAdded(
        $professionName,
        ProfessionLevels $professionLevels
    )
    {
        /** @var ProfessionLevelsTest|ProfessionLevelsTestMoreLevelsTrait $this */
        /** @var FighterLevel|\Mockery\MockInterface $firstLevel */
        $firstLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf($this->geProfessionLevelClass($professionName), $firstLevel);
        $this->assertSame(1, count($professionLevels->getLevels()));

        /** @var LevelValue|\Mockery\MockInterface $firstLevelValue */
        $firstLevelValue = $firstLevel->getLevelValue();
        $firstLevelValue->shouldReceive('getValue')
            ->atLeast()->once()
            ->andReturn(1);
        $firstLevel->shouldReceive('isFirstLevel')
            ->andReturn(true);
        /** @var FighterLevel|\Mockery\MockInterface $nextLevel */
        $nextLevel = \Mockery::mock($this->geProfessionLevelClass($professionName));
        $nextLevel->shouldReceive('getProfession')
            ->andReturn($profession = \Mockery::mock(Profession::class));
        $profession->shouldReceive('getName')
            ->atLeast()->once()
            ->andReturn($professionName);
        $nextLevel->shouldReceive('getLevelValue')
            ->atLeast()->once()
            ->andReturn($nextLevelValue = \Mockery::mock(LevelValue::class));
        $nextLevelValue->shouldReceive('getValue')
            ->atLeast()->once()
            ->andReturn(2);
        $nextLevel->shouldReceive('isFirstLevel')
            ->andReturn(false);

        $addProfessionLevel = 'add' . ucfirst($professionName) . 'Level';
        $professionLevels->$addProfessionLevel($nextLevel);

        $this->assertSame($firstLevel, $professionLevels->getFirstLevel(), 'After adding a new level the old one is no more the first.');
        $getProfessionLevel = 'get' . ucfirst($professionName) . 'Levels';
        $this->assertSame([$firstLevel, $nextLevel], $professionLevels->$getProfessionLevel()->toArray(), 'Expected only first and last levels of the same profession.');
        $this->assertSame([$firstLevel, $nextLevel], $professionLevels->getLevels(), 'Expected only first and last levels of the same profession.');

        return $professionLevels;
    }

    private function geProfessionLevelClass($professionName)
    {
        $abstractClass = ProfessionLevel::class;

        return preg_replace('~ProfessionLevel$~', ucfirst($professionName) . 'Level', $abstractClass);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_fighter_levels_can_be_added
     */
    public function fighter_has_properties_increment_summary_as_expected(ProfessionLevels $professionLevels)
    {
        $this->professionHasPropertiesModifierSummaryAsExpected(Fighter::FIGHTER, $professionLevels);
    }

    private function professionHasPropertiesModifierSummaryAsExpected($professionName, ProfessionLevels $professionLevels)
    {
        foreach ([Strength::STRENGTH, Agility::AGILITY, Knack::KNACK, Will::WILL, Intelligence::INTELLIGENCE, Charisma::CHARISMA] as $propertyName) {
            $this->professionHasPropertyModifierSummaryAsExpected($professionName, $propertyName, $professionLevels);
        }
    }

    private function professionHasPropertyModifierSummaryAsExpected(
        $professionName,
        $propertyName,
        ProfessionLevels $professionLevels
    )
    {
        $propertySummary = 0;
        foreach ($professionLevels as $level) {
            /** @var ProfessionLevel|\Mockery\MockInterface $level */
            if (!$level->isFirstLevel()) {
                $level->shouldReceive('get' . ucfirst($propertyName) . 'Increment')
                    ->atLeast()->once()
                    ->andReturn($propertyIncrement = \Mockery::mock(BaseProperty::class));
                $propertyIncrement->shouldReceive('getValue')
                    ->atLeast()->once()
                    ->andReturn($propertyValue = 123);
                $propertySummary += $propertyValue;
            }
        }
        /** @var ProfessionLevelsTest|ProfessionLevelsTestMoreLevelsTrait $this */
        $getPropertyModifierSummary = 'get' . ucfirst($propertyName) . 'ModifierSummary';
        $this->assertSame(
            ($this->isPrimaryProperty_MoreLevels($propertyName, $professionName) ? 1 : 0) + $propertySummary,
            $professionLevels->$getPropertyModifierSummary(),
            "The modifier summary of property $propertyName should be " . (($this->isPrimaryProperty_MoreLevels($propertyName, $professionName) ? 1 : 0) + $propertySummary) .
            " for $professionName, got " . $professionLevels->$getPropertyModifierSummary()
        );
    }

    /**
     * @param string $propertyName
     * @param string $professionName
     *
     * @return bool
     */
    private function isPrimaryProperty_MoreLevels($propertyName, $professionName)
    {
        return in_array($propertyName, $this->getPrimaryProperties_MoreLevels($professionName));
    }

    private function getPrimaryProperties_MoreLevels($professionName)
    {
        switch ($professionName) {
            case Fighter::FIGHTER :
                return [Strength::STRENGTH, Agility::AGILITY];
            case Priest::PRIEST :
                return [Will::WILL, Charisma::CHARISMA];
            case Ranger::RANGER :
                return [Strength::STRENGTH, Knack::KNACK];
            case Theurgist::THEURGIST :
                return [Intelligence::INTELLIGENCE, Charisma::CHARISMA];
            case Thief::THIEF :
                return [Knack::KNACK, Agility::AGILITY];
            case Wizard::WIZARD :
                return [Will::WILL, Intelligence::INTELLIGENCE];
            default :
                throw new \RuntimeException('Unknown profession name ' . var_export($professionName, true));
        }
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
        $this->addingLevelWithOccupiedSequenceCauseException(Fighter::FIGHTER, $professionLevels);
    }

    private function addingLevelWithOccupiedSequenceCauseException(
        $professionName,
        ProfessionLevels $professionLevels
    )
    {
        /** @var ProfessionLevelsTest|ProfessionLevelsTestMoreLevelsTrait $this */
        $this->assertSame(2, count($professionLevels->getLevels()));
        /** @var FighterLevel|\Mockery\MockInterface $anotherLevel */

        $anotherLevel = \Mockery::mock($this->geProfessionLevelClass($professionName));
        $anotherLevel->shouldReceive('getProfession')
            ->andReturn($profession = \Mockery::mock(Profession::class));
        $profession->shouldReceive('getName')
            ->andReturn($professionName);
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getValue')
            ->andReturn(2 /* already occupied level rank */);

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
        $this->addingLevelWithTooHighSequenceCauseException(Fighter::FIGHTER, $professionLevels);
    }

    private function addingLevelWithTooHighSequenceCauseException(
        $professionName,
        ProfessionLevels $professionLevels
    )
    {
        /** @var ProfessionLevelsTest|ProfessionLevelsTestMoreLevelsTrait $this */
        $this->assertSame(2, count($professionLevels->getLevels()));

        /** @var FighterLevel|\Mockery\MockInterface $anotherLevel */
        $anotherLevel = \Mockery::mock($this->geProfessionLevelClass($professionName));
        $anotherLevel->shouldReceive('getProfession')
            ->andReturn($profession = \Mockery::mock(Profession::class));
        $profession->shouldReceive('getName')
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
        $this->changedLevelDuringUsageCauseException(Fighter::FIGHTER, $professionLevels);
    }

    private function changedLevelDuringUsageCauseException(
        $professionName,
        ProfessionLevels $professionLevels
    )
    {
        /** @var ProfessionLevelsTest|ProfessionLevelsTestMoreLevelsTrait $this */
        $this->assertSame(2, count($professionLevels->getLevels()));
        /** @var FighterLevel|\Mockery\MockInterface $anotherLevel */
        $anotherLevel = \Mockery::mock($this->geProfessionLevelClass($professionName));
        $anotherLevel->shouldReceive('getProfession')
            ->andReturn($profession = \Mockery::mock(Profession::class));
        $profession->shouldReceive('getName')
            ->andReturn(Fighter::FIGHTER);
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
     */
    public function priest_has_properties_modifier_summary_as_expected(ProfessionLevels $professionLevels)
    {
        $this->professionHasPropertiesModifierSummaryAsExpected('priest', $professionLevels);
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
     */
    public function ranger_has_properties_modifier_summary_as_expected(ProfessionLevels $professionLevels)
    {
        $this->professionHasPropertiesModifierSummaryAsExpected('ranger', $professionLevels);
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
     */
    public function theurgist_has_properties_modifier_summary_as_expected(ProfessionLevels $professionLevels)
    {
        $this->professionHasPropertiesModifierSummaryAsExpected('theurgist', $professionLevels);
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
     */
    public function thief_has_properties_modifier_summary_as_expected(ProfessionLevels $professionLevels)
    {
        $this->professionHasPropertiesModifierSummaryAsExpected('thief', $professionLevels);
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
     */
    public function wizard_has_properties_modifier_summary_as_expected(ProfessionLevels $professionLevels)
    {
        $this->professionHasPropertiesModifierSummaryAsExpected('wizard', $professionLevels);
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
