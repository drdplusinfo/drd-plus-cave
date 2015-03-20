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

trait ProfessionLevelsTestFirstLevelsTrait
{

    /**
     * @test
     * @depends can_create_instance
     */
    public function fighter_level_can_be_added()
    {
        /** @var ProfessionLevelsTest $this */
        $professionLevels = new ProfessionLevels();
        /** @var \Mockery\MockInterface|FighterLevel $fighterLevel */
        $fighterLevel = \Mockery::mock(FighterLevel::class);
        $fighterLevel->shouldReceive('getProfessionCode')
            ->andReturn('fighter');
        $fighterLevel->shouldReceive('getLevelValue')
            ->atLeast()->once()
            ->andReturn($levelValue = \Mockery::mock(LevelValue::class));
        $levelValue->shouldReceive('getRank')
            ->atLeast()->once()
            ->andReturn(1);
        $professionLevels->addFighterLevel($fighterLevel);
        $this->assertSame($fighterLevel, $professionLevels->getFirstLevel());
        $this->assertSame([$fighterLevel], $professionLevels->getFighterLevels()->toArray());
        $this->assertSame([$fighterLevel], $professionLevels->getLevels());

        return $professionLevels;
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends fighter_level_can_be_added
     */
    public function fighter_as_first_level_has_strength_and_agility_increment(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        /** @var FighterLevel|\Mockery\MockInterface $fighterLevel */
        $fighterLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf(FighterLevel::class, $fighterLevel);
        // non-mocked methods are propagated to originals
        $fighterLevel->shouldDeferMissing();
        $this->assertSame(1, $professionLevels->getStrengthFirstLevelIncrement());
        $this->assertSame(1, $professionLevels->getAgilityFirstLevelIncrement());
        $this->assertSame(0, $professionLevels->getKnackFirstLevelIncrement());
        $this->assertSame(0, $professionLevels->getWillFirstLevelIncrement());
        $this->assertSame(0, $professionLevels->getIntelligenceFirstLevelIncrement());
        $this->assertSame(0, $professionLevels->getCharismaFirstLevelIncrement());
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function priest_level_can_be_added()
    {
        /** @var ProfessionLevelsTest $this */
        $professionLevels = new ProfessionLevels();
        /** @var \Mockery\MockInterface|PriestLevel $priestLevel */
        $priestLevel = \Mockery::mock(PriestLevel::class);
        $priestLevel->shouldReceive('getProfessionCode')
            ->andReturn('priest');
        $priestLevel->shouldReceive('getLevelValue')
            ->atLeast()->once()
            ->andReturn($levelValue = \Mockery::mock(LevelValue::class));
        $levelValue->shouldReceive('getRank')
            ->atLeast()->once()
            ->andReturn(1);
        $professionLevels->addPriestLevel($priestLevel);
        $this->assertSame($priestLevel, $professionLevels->getFirstLevel());
        $this->assertSame([$priestLevel], $professionLevels->getPriestLevels()->toArray());
        $this->assertSame([$priestLevel], $professionLevels->getLevels());

        return $professionLevels;
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends priest_level_can_be_added
     */
    public function priest_as_first_level_has_will_and_charisma_increment(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        /** @var PriestLevel|\Mockery\MockInterface $priestLevel */
        $priestLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf(PriestLevel::class, $priestLevel);
        // non-mocked methods are propagated to originals
        $priestLevel->shouldDeferMissing();
        $this->assertSame(0, $professionLevels->getStrengthFirstLevelIncrement());
        $this->assertSame(0, $professionLevels->getAgilityFirstLevelIncrement());
        $this->assertSame(0, $professionLevels->getKnackFirstLevelIncrement());
        $this->assertSame(1, $professionLevels->getWillFirstLevelIncrement());
        $this->assertSame(0, $professionLevels->getIntelligenceFirstLevelIncrement());
        $this->assertSame(1, $professionLevels->getCharismaFirstLevelIncrement());
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function ranger_level_can_be_added()
    {
        /** @var ProfessionLevelsTest $this */
        $professionLevels = new ProfessionLevels();
        /** @var \Mockery\MockInterface|RangerLevel $rangerLevel */
        $rangerLevel = \Mockery::mock(RangerLevel::class);
        $rangerLevel->shouldReceive('getProfessionCode')
            ->andReturn('ranger');
        $rangerLevel->shouldReceive('getLevelValue')
            ->atLeast()->once()
            ->andReturn($levelValue = \Mockery::mock(LevelValue::class));
        $levelValue->shouldReceive('getRank')
            ->atLeast()->once()
            ->andReturn(1);
        $professionLevels->addRangerLevel($rangerLevel);
        $this->assertSame($rangerLevel, $professionLevels->getFirstLevel());
        $this->assertSame([$rangerLevel], $professionLevels->getRangerLevels()->toArray());
        $this->assertSame([$rangerLevel], $professionLevels->getLevels());

        return $professionLevels;
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends ranger_level_can_be_added
     */
    public function ranger_as_first_level_has_strength_and_knack_increment(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        /** @var RangerLevel|\Mockery\MockInterface $rangerLevel */
        $rangerLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf(RangerLevel::class, $rangerLevel);
        // non-mocked methods are propagated to originals
        $rangerLevel->shouldDeferMissing();
        $this->assertSame(1, $professionLevels->getStrengthFirstLevelIncrement());
        $this->assertSame(0, $professionLevels->getAgilityFirstLevelIncrement());
        $this->assertSame(1, $professionLevels->getKnackFirstLevelIncrement());
        $this->assertSame(0, $professionLevels->getWillFirstLevelIncrement());
        $this->assertSame(0, $professionLevels->getIntelligenceFirstLevelIncrement());
        $this->assertSame(0, $professionLevels->getCharismaFirstLevelIncrement());
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function theurgist_level_can_be_added()
    {
        /** @var ProfessionLevelsTest $this */
        $professionLevels = new ProfessionLevels();
        /** @var \Mockery\MockInterface|TheurgistLevel $theurgistLevel */
        $theurgistLevel = \Mockery::mock(TheurgistLevel::class);
        $theurgistLevel->shouldReceive('getProfessionCode')
            ->andReturn('theurgist');
        $theurgistLevel->shouldReceive('getLevelValue')
            ->atLeast()->once()
            ->andReturn($levelValue = \Mockery::mock(LevelValue::class));
        $levelValue->shouldReceive('getRank')
            ->atLeast()->once()
            ->andReturn(1);
        $professionLevels->addTheurgistLevel($theurgistLevel);
        $this->assertSame($theurgistLevel, $professionLevels->getFirstLevel());
        $this->assertSame([$theurgistLevel], $professionLevels->getTheurgistLevels()->toArray());
        $this->assertSame([$theurgistLevel], $professionLevels->getLevels());

        return $professionLevels;
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends theurgist_level_can_be_added
     */
    public function theurgist_as_first_level_has_intelligence_and_charisma_increment(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        /** @var TheurgistLevel|\Mockery\MockInterface $theurgistLevel */
        $theurgistLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf(TheurgistLevel::class, $theurgistLevel);
        // non-mocked methods are propagated to originals
        $theurgistLevel->shouldDeferMissing();
        $this->assertSame(0, $professionLevels->getStrengthFirstLevelIncrement());
        $this->assertSame(0, $professionLevels->getAgilityFirstLevelIncrement());
        $this->assertSame(0, $professionLevels->getKnackFirstLevelIncrement());
        $this->assertSame(0, $professionLevels->getWillFirstLevelIncrement());
        $this->assertSame(1, $professionLevels->getIntelligenceFirstLevelIncrement());
        $this->assertSame(1, $professionLevels->getCharismaFirstLevelIncrement());
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function thief_level_can_be_added()
    {
        /** @var ProfessionLevelsTest $this */
        $professionLevels = new ProfessionLevels();
        /** @var \Mockery\MockInterface|ThiefLevel $thiefLevel */
        $thiefLevel = \Mockery::mock(ThiefLevel::class);
        $thiefLevel->shouldReceive('getProfessionCode')
            ->andReturn('thief');
        $thiefLevel->shouldReceive('getLevelValue')
            ->atLeast()->once()
            ->andReturn($levelValue = \Mockery::mock(LevelValue::class));
        $levelValue->shouldReceive('getRank')
            ->atLeast()->once()
            ->andReturn(1);
        $professionLevels->addThiefLevel($thiefLevel);
        $this->assertSame($thiefLevel, $professionLevels->getFirstLevel());
        $this->assertSame([$thiefLevel], $professionLevels->getThiefLevels()->toArray());
        $this->assertSame([$thiefLevel], $professionLevels->getLevels());

        return $professionLevels;
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends thief_level_can_be_added
     */
    public function thief_as_first_level_has_agility_and_knack_increment(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        /** @var ThiefLevel|\Mockery\MockInterface $thiefLevel */
        $thiefLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf(ThiefLevel::class, $thiefLevel);
        // non-mocked methods are propagated to originals
        $thiefLevel->shouldDeferMissing();
        $this->assertSame(0, $professionLevels->getStrengthFirstLevelIncrement());
        $this->assertSame(1, $professionLevels->getAgilityFirstLevelIncrement());
        $this->assertSame(1, $professionLevels->getKnackFirstLevelIncrement());
        $this->assertSame(0, $professionLevels->getWillFirstLevelIncrement());
        $this->assertSame(0, $professionLevels->getIntelligenceFirstLevelIncrement());
        $this->assertSame(0, $professionLevels->getCharismaFirstLevelIncrement());
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function wizard_level_can_be_added()
    {
        /** @var ProfessionLevelsTest $this */
        $professionLevels = new ProfessionLevels();
        /** @var \Mockery\MockInterface|WizardLevel $wizardLevel */
        $wizardLevel = \Mockery::mock(WizardLevel::class);
        $wizardLevel->shouldReceive('getProfessionCode')
            ->andReturn('wizard');
        $wizardLevel->shouldReceive('getLevelValue')
            ->atLeast()->once()
            ->andReturn($levelValue = \Mockery::mock(LevelValue::class));
        $levelValue->shouldReceive('getRank')
            ->atLeast()->once()
            ->andReturn(1);
        $professionLevels->addWizardLevel($wizardLevel);
        $this->assertSame($wizardLevel, $professionLevels->getFirstLevel());
        $this->assertSame([$wizardLevel], $professionLevels->getWizardLevels()->toArray());
        $this->assertSame([$wizardLevel], $professionLevels->getLevels());

        return $professionLevels;
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends wizard_level_can_be_added
     */
    public function wizard_as_first_level_has_will_and_intelligence_increment(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        /** @var WizardLevel|\Mockery\MockInterface $wizardLevel */
        $wizardLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf(WizardLevel::class, $wizardLevel);
        // non-mocked methods are propagated to originals
        $wizardLevel->shouldDeferMissing();
        $this->assertSame(0, $professionLevels->getStrengthFirstLevelIncrement());
        $this->assertSame(0, $professionLevels->getAgilityFirstLevelIncrement());
        $this->assertSame(0, $professionLevels->getKnackFirstLevelIncrement());
        $this->assertSame(1, $professionLevels->getWillFirstLevelIncrement());
        $this->assertSame(1, $professionLevels->getIntelligenceFirstLevelIncrement());
        $this->assertSame(0, $professionLevels->getCharismaFirstLevelIncrement());
    }

}
