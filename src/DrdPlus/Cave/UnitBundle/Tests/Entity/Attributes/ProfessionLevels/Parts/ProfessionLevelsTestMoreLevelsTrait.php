<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\ProfessionLevels\Parts;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\FighterLevel;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\LevelValue;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\PriestLevel;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ProfessionLevelsTest;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\RangerLevel;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\TheurgistLevel;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ThiefLevel;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\WizardLevel;

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
        /** @var ProfessionLevelsTest $this */
        /** @var FighterLevel|\Mockery\MockInterface $firstLevel */
        $firstLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf(FighterLevel::class, $firstLevel);
        $this->assertSame(1, count($professionLevels->getLevels()));

        /** @var LevelValue|\Mockery\MockInterface $firstLevelValue */
        $firstLevelValue = $firstLevel->getLevelValue();
        $firstLevelValue->shouldReceive('getRank')
            ->andReturn(1);
        /** @var FighterLevel|\Mockery\MockInterface $anotherLevel */
        $anotherLevel = \Mockery::mock(FighterLevel::class);
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn('fighter');
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getRank')
            ->andReturn(2);

        $professionLevels->addFighterLevel($anotherLevel);

        $this->assertSame($firstLevel, $professionLevels->getFirstLevel());
        $this->assertSame([$firstLevel, $anotherLevel], $professionLevels->getFighterLevels()->toArray());
        $this->assertSame([$firstLevel, $anotherLevel], $professionLevels->getLevels());

        return $professionLevels;
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
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(2, count($professionLevels->getLevels()));
        /** @var FighterLevel|\Mockery\MockInterface $anotherLevel */

        $anotherLevel = \Mockery::mock(FighterLevel::class);
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn('fighter');
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getRank')
            ->andReturn(2 /* already occupied level tank */);

        $professionLevels->addFighterLevel($anotherLevel);
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
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(2, count($professionLevels->getLevels()));
        /** @var FighterLevel|\Mockery\MockInterface $anotherLevel */

        $anotherLevel = \Mockery::mock(FighterLevel::class);
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn('fighter');
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getRank')
            ->andReturn(4 /* skipped rank 3 */);

        $professionLevels->addFighterLevel($anotherLevel);
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
        /** @var ProfessionLevelsTest $this */
        /** @var PriestLevel|\Mockery\MockInterface $firstLevel */
        $firstLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf(PriestLevel::class, $firstLevel);
        $this->assertSame(1, count($professionLevels->getLevels()));

        /** @var LevelValue|\Mockery\MockInterface $firstLevelValue */
        $firstLevelValue = $firstLevel->getLevelValue();
        $firstLevelValue->shouldReceive('getRank')
            ->andReturn(1);
        /** @var PriestLevel|\Mockery\MockInterface $anotherLevel */
        $anotherLevel = \Mockery::mock(PriestLevel::class);
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn('priest');
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getRank')
            ->andReturn(2);

        $professionLevels->addPriestLevel($anotherLevel);

        $this->assertSame($firstLevel, $professionLevels->getFirstLevel());
        $this->assertSame([$firstLevel, $anotherLevel], $professionLevels->getPriestLevels()->toArray());
        $this->assertSame([$firstLevel, $anotherLevel], $professionLevels->getLevels());

        return $professionLevels;
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
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(2, count($professionLevels->getLevels()));
        /** @var PriestLevel|\Mockery\MockInterface $anotherLevel */

        $anotherLevel = \Mockery::mock(PriestLevel::class);
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn('priest');
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getRank')
            ->andReturn(2 /* already occupied level tank */);

        $professionLevels->addPriestLevel($anotherLevel);
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
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(2, count($professionLevels->getLevels()));
        /** @var PriestLevel|\Mockery\MockInterface $anotherLevel */

        $anotherLevel = \Mockery::mock(PriestLevel::class);
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn('priest');
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getRank')
            ->andReturn(4 /* skipped rank 3 */);

        $professionLevels->addPriestLevel($anotherLevel);
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
        /** @var ProfessionLevelsTest $this */
        /** @var RangerLevel|\Mockery\MockInterface $firstLevel */
        $firstLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf(RangerLevel::class, $firstLevel);
        $this->assertSame(1, count($professionLevels->getLevels()));

        /** @var LevelValue|\Mockery\MockInterface $firstLevelValue */
        $firstLevelValue = $firstLevel->getLevelValue();
        $firstLevelValue->shouldReceive('getRank')
            ->andReturn(1);
        /** @var RangerLevel|\Mockery\MockInterface $anotherLevel */
        $anotherLevel = \Mockery::mock(RangerLevel::class);
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn('ranger');
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getRank')
            ->andReturn(2);

        $professionLevels->addRangerLevel($anotherLevel);

        $this->assertSame($firstLevel, $professionLevels->getFirstLevel());
        $this->assertSame([$firstLevel, $anotherLevel], $professionLevels->getRangerLevels()->toArray());
        $this->assertSame([$firstLevel, $anotherLevel], $professionLevels->getLevels());

        return $professionLevels;
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
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(2, count($professionLevels->getLevels()));
        /** @var RangerLevel|\Mockery\MockInterface $anotherLevel */

        $anotherLevel = \Mockery::mock(RangerLevel::class);
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn('ranger');
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getRank')
            ->andReturn(2 /* already occupied level tank */);

        $professionLevels->addRangerLevel($anotherLevel);
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
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(2, count($professionLevels->getLevels()));
        /** @var RangerLevel|\Mockery\MockInterface $anotherLevel */

        $anotherLevel = \Mockery::mock(RangerLevel::class);
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn('ranger');
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getRank')
            ->andReturn(4 /* skipped rank 3 */);

        $professionLevels->addRangerLevel($anotherLevel);
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
        /** @var ProfessionLevelsTest $this */
        /** @var TheurgistLevel|\Mockery\MockInterface $firstLevel */
        $firstLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf(TheurgistLevel::class, $firstLevel);
        $this->assertSame(1, count($professionLevels->getLevels()));

        /** @var LevelValue|\Mockery\MockInterface $firstLevelValue */
        $firstLevelValue = $firstLevel->getLevelValue();
        $firstLevelValue->shouldReceive('getRank')
            ->andReturn(1);
        /** @var TheurgistLevel|\Mockery\MockInterface $anotherLevel */
        $anotherLevel = \Mockery::mock(TheurgistLevel::class);
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn('theurgist');
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getRank')
            ->andReturn(2);

        $professionLevels->addTheurgistLevel($anotherLevel);

        $this->assertSame($firstLevel, $professionLevels->getFirstLevel());
        $this->assertSame([$firstLevel, $anotherLevel], $professionLevels->getTheurgistLevels()->toArray());
        $this->assertSame([$firstLevel, $anotherLevel], $professionLevels->getLevels());

        return $professionLevels;
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
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(2, count($professionLevels->getLevels()));
        /** @var TheurgistLevel|\Mockery\MockInterface $anotherLevel */

        $anotherLevel = \Mockery::mock(TheurgistLevel::class);
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn('theurgist');
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getRank')
            ->andReturn(2 /* already occupied level tank */);

        $professionLevels->addTheurgistLevel($anotherLevel);
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
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(2, count($professionLevels->getLevels()));
        /** @var TheurgistLevel|\Mockery\MockInterface $anotherLevel */

        $anotherLevel = \Mockery::mock(TheurgistLevel::class);
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn('theurgist');
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getRank')
            ->andReturn(4 /* skipped rank 3 */);

        $professionLevels->addTheurgistLevel($anotherLevel);
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
        /** @var ProfessionLevelsTest $this */
        /** @var ThiefLevel|\Mockery\MockInterface $firstLevel */
        $firstLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf(ThiefLevel::class, $firstLevel);
        $this->assertSame(1, count($professionLevels->getLevels()));

        /** @var LevelValue|\Mockery\MockInterface $firstLevelValue */
        $firstLevelValue = $firstLevel->getLevelValue();
        $firstLevelValue->shouldReceive('getRank')
            ->andReturn(1);
        /** @var ThiefLevel|\Mockery\MockInterface $anotherLevel */
        $anotherLevel = \Mockery::mock(ThiefLevel::class);
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn('thief');
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getRank')
            ->andReturn(2);

        $professionLevels->addThiefLevel($anotherLevel);

        $this->assertSame($firstLevel, $professionLevels->getFirstLevel());
        $this->assertSame([$firstLevel, $anotherLevel], $professionLevels->getThiefLevels()->toArray());
        $this->assertSame([$firstLevel, $anotherLevel], $professionLevels->getLevels());

        return $professionLevels;
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
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(2, count($professionLevels->getLevels()));
        /** @var ThiefLevel|\Mockery\MockInterface $anotherLevel */

        $anotherLevel = \Mockery::mock(ThiefLevel::class);
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn('thief');
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getRank')
            ->andReturn(2 /* already occupied level tank */);

        $professionLevels->addThiefLevel($anotherLevel);
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
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(2, count($professionLevels->getLevels()));
        /** @var ThiefLevel|\Mockery\MockInterface $anotherLevel */

        $anotherLevel = \Mockery::mock(ThiefLevel::class);
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn('thief');
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getRank')
            ->andReturn(4 /* skipped rank 3 */);

        $professionLevels->addThiefLevel($anotherLevel);
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
        /** @var ProfessionLevelsTest $this */
        /** @var WizardLevel|\Mockery\MockInterface $firstLevel */
        $firstLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf(WizardLevel::class, $firstLevel);
        $this->assertSame(1, count($professionLevels->getLevels()));

        /** @var LevelValue|\Mockery\MockInterface $firstLevelValue */
        $firstLevelValue = $firstLevel->getLevelValue();
        $firstLevelValue->shouldReceive('getRank')
            ->andReturn(1);
        /** @var WizardLevel|\Mockery\MockInterface $anotherLevel */
        $anotherLevel = \Mockery::mock(WizardLevel::class);
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn('wizard');
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getRank')
            ->andReturn(2);

        $professionLevels->addWizardLevel($anotherLevel);

        $this->assertSame($firstLevel, $professionLevels->getFirstLevel());
        $this->assertSame([$firstLevel, $anotherLevel], $professionLevels->getWizardLevels()->toArray());
        $this->assertSame([$firstLevel, $anotherLevel], $professionLevels->getLevels());

        return $professionLevels;
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
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(2, count($professionLevels->getLevels()));
        /** @var WizardLevel|\Mockery\MockInterface $anotherLevel */

        $anotherLevel = \Mockery::mock(WizardLevel::class);
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn('wizard');
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getRank')
            ->andReturn(2 /* already occupied level tank */);

        $professionLevels->addWizardLevel($anotherLevel);
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
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(2, count($professionLevels->getLevels()));
        /** @var WizardLevel|\Mockery\MockInterface $anotherLevel */

        $anotherLevel = \Mockery::mock(WizardLevel::class);
        $anotherLevel->shouldDeferMissing();
        $anotherLevel->shouldReceive('getProfessionCode')
            ->andReturn('wizard');
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getRank')
            ->andReturn(4 /* skipped rank 3 */);

        $professionLevels->addWizardLevel($anotherLevel);
    }
}
