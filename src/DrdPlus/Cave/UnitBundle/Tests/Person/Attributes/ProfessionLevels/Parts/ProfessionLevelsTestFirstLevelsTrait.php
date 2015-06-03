<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\ProfessionLevels\Parts;

use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\FighterLevel;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\LevelValue;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevelsTest;

trait ProfessionLevelsTestFirstLevelsTrait
{

    /**
     * @test
     * @depends can_create_instance
     */
    public function fighter_level_can_be_added()
    {
        return $this->levelCanBeAdded('fighter');
    }

    /**
     * @param string $professionName
     *
     * @return ProfessionLevels
     */
    private function levelCanBeAdded($professionName)
    {
        /** @var ProfessionLevelsTest|ProfessionLevelsTestFirstLevelsTrait $this */
        $professionLevels = new ProfessionLevels();
        /** @var \Mockery\MockInterface|ProfessionLevel $professionLevel */
        $professionLevel = \Mockery::mock($this->getFirstLevelsProfessionLevelClass($professionName));
        $professionLevel->shouldReceive('getProfessionCode')
            ->andReturn($professionName);
        $professionLevel->shouldReceive('getLevelValue')
            ->atLeast()->once()
            ->andReturn($levelValue = \Mockery::mock(LevelValue::class));
        $levelValue->shouldReceive('getValue')
            ->atLeast()->once()
            ->andReturn(1);
        $adder = 'add' . ucfirst($professionName) . 'Level';
        $professionLevels->$adder($professionLevel);
        $this->assertSame($professionLevel, $professionLevels->getFirstLevel());
        $levelsGetter = 'get' . ucfirst($professionName) . 'levels';
        $this->assertSame([$professionLevel], $professionLevels->$levelsGetter()->toArray());
        $this->assertSame([$professionLevel], $professionLevels->getLevels());

        return $professionLevels;
    }

    private function getFirstLevelsProfessionLevelClass($professionName)
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
    public function fighter_at_first_level_has_strength_and_agility_increment(ProfessionLevels $professionLevels)
    {
        $this->atFirstLevelHasIncrementOfPrimaryProperties('fighter', $professionLevels);
    }

    private function atFirstLevelHasIncrementOfPrimaryProperties(
        $professionName,
        ProfessionLevels $professionLevels
    )
    {
        $primaryProperties = $this->getFirstLevelsPrimaryPropertiesToProfession($professionName);
        /** @var ProfessionLevelsTest|ProfessionLevelsTestFirstLevelsTrait $this */
        /** @var FighterLevel|\Mockery\MockInterface $professionLevel */
        $professionLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf($this->getFirstLevelsProfessionLevelClass($professionName), $professionLevel);
        // non-mocked methods are propagated to originals
        $professionLevel->shouldDeferMissing();
        $this->assertSame(
            in_array('strength', $primaryProperties) ? 1 : 0,
            $professionLevels->getStrengthIncrementForFirstLevel()
        );
        $this->assertSame(
            in_array('agility', $primaryProperties) ? 1 : 0,
            $professionLevels->getAgilityIncrementForFirstLevel()
        );
        $this->assertSame(
            in_array('knack', $primaryProperties) ? 1 : 0,
            $professionLevels->getKnackIncrementForFirstLevel()
        );
        $this->assertSame(
            in_array('will', $primaryProperties) ? 1 : 0,
            $professionLevels->getWillIncrementForFirstLevel()
        );
        $this->assertSame(
            in_array('intelligence', $primaryProperties) ? 1 : 0,
            $professionLevels->getIntelligenceIncrementForFirstLevel()
        );
        $this->assertSame(
            in_array('charisma', $primaryProperties) ? 1 : 0,
            $professionLevels->getCharismaIncrementForFirstLevel()
        );
    }

    private function getFirstLevelsPrimaryPropertiesToProfession($professionName)
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
     * @expectedException \LogicException
     */
    public function fighter_missing_level_value_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->missingLevelValueCauseException('fighter', $professionLevels);
    }

    /**
     * @param string $professionName
     * @param ProfessionLevels $professionLevels
     *
     * @return ProfessionLevels
     */
    private function missingLevelValueCauseException($professionName, ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest|ProfessionLevelsTestFirstLevelsTrait $this */
        /** @var \Mockery\MockInterface|ProfessionLevel $professionLevel */
        $professionLevel = \Mockery::mock($this->getFirstLevelsProfessionLevelClass($professionName));
        $professionLevel->shouldReceive('getProfessionCode')
            ->andReturn($professionName);
        $professionLevel->shouldReceive('getLevelValue')
            ->atLeast()->once()
            ->andReturn($levelValue = \Mockery::mock(LevelValue::class));
        $levelValue->shouldReceive('getValue')
            ->atLeast()->once()
            ->andReturn(0);
        $professionLevel->shouldReceive('getId')
            ->andReturn('foo');
        $adder = 'add' . ucfirst($professionName) . 'Level';
        $professionLevels->$adder($professionLevel);
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function priest_level_can_be_added()
    {
        return $this->levelCanBeAdded('priest');
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends priest_level_can_be_added
     */
    public function priest_at_first_level_has_will_and_charisma_increment(ProfessionLevels $professionLevels)
    {
        $this->atFirstLevelHasIncrementOfPrimaryProperties('priest', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends priest_level_can_be_added
     * @expectedException \LogicException
     */
    public function priest_missing_level_value_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->missingLevelValueCauseException('priest', $professionLevels);
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function ranger_level_can_be_added()
    {
        return $this->levelCanBeAdded('ranger');
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends ranger_level_can_be_added
     */
    public function ranger_at_first_level_has_strength_and_knack_increment(ProfessionLevels $professionLevels)
    {
        $this->atFirstLevelHasIncrementOfPrimaryProperties('ranger', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends ranger_level_can_be_added
     * @expectedException \LogicException
     */
    public function ranger_missing_level_value_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->missingLevelValueCauseException('ranger', $professionLevels);
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function theurgist_level_can_be_added()
    {
        return $this->levelCanBeAdded('theurgist');
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends theurgist_level_can_be_added
     */
    public function theurgist_at_first_level_has_intelligence_and_charisma_increment(ProfessionLevels $professionLevels)
    {
        $this->atFirstLevelHasIncrementOfPrimaryProperties('theurgist', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends theurgist_level_can_be_added
     * @expectedException \LogicException
     */
    public function theurgist_missing_level_value_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->missingLevelValueCauseException('theurgist', $professionLevels);
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function thief_level_can_be_added()
    {
        return $this->levelCanBeAdded('thief');
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends thief_level_can_be_added
     */
    public function thief_at_first_level_has_agility_and_knack_increment(ProfessionLevels $professionLevels)
    {
        $this->atFirstLevelHasIncrementOfPrimaryProperties('thief', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends thief_level_can_be_added
     * @expectedException \LogicException
     */
    public function thief_missing_level_value_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->missingLevelValueCauseException('thief', $professionLevels);
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function wizard_level_can_be_added()
    {
        return $this->levelCanBeAdded('wizard');
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends wizard_level_can_be_added
     */
    public function wizard_at_first_level_has_will_and_intelligence_increment(ProfessionLevels $professionLevels)
    {
        $this->atFirstLevelHasIncrementOfPrimaryProperties('wizard', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends wizard_level_can_be_added
     * @expectedException \LogicException
     */
    public function wizard_missing_level_value_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->missingLevelValueCauseException('wizard', $professionLevels);
    }

}
