<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\ProfessionLevels\Parts;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\FighterLevel;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\LevelValue;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ProfessionLevelsTest;

trait ProfessionLevelsTestFirstLevelsTrait
{

    /**
     * @test
     * @depends can_create_instance
     */
    public function fighter_level_can_be_added()
    {
        return $this->level_can_be_added('fighter');
    }

    /**
     * @param string $professionName
     *
     * @return ProfessionLevels
     */
    private function level_can_be_added($professionName)
    {
        /** @var ProfessionLevelsTest|ProfessionLevelsTestFirstLevelsTrait $this */
        $professionLevels = new ProfessionLevels();
        /** @var \Mockery\MockInterface|ProfessionLevel $professionLevel */
        $professionLevel = \Mockery::mock($this->getProfessionLevelClass($professionName));
        $professionLevel->shouldReceive('getProfessionCode')
            ->andReturn($professionName);
        $professionLevel->shouldReceive('getLevelValue')
            ->atLeast()->once()
            ->andReturn($levelValue = \Mockery::mock(LevelValue::class));
        $levelValue->shouldReceive('getRank')
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

    private function getProfessionLevelClass($professionName)
    {
        return '\DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\\'
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
        $this->atFirstLevelHasIncrementOfMainProperties('fighter', ['strength', 'agility'], $professionLevels);
    }

    private function atFirstLevelHasIncrementOfMainProperties(
        $professionName,
        array $mainProperties,
        ProfessionLevels $professionLevels
    )
    {
        /** @var ProfessionLevelsTest|ProfessionLevelsTestFirstLevelsTrait $this */
        /** @var FighterLevel|\Mockery\MockInterface $professionLevel */
        $professionLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf($this->getProfessionLevelClass($professionName), $professionLevel);
        // non-mocked methods are propagated to originals
        $professionLevel->shouldDeferMissing();
        $this->assertSame(
            in_array('strength', $mainProperties) ? 1 : 0,
            $professionLevels->getStrengthFirstLevelIncrement()
        );
        $this->assertSame(
            in_array('agility', $mainProperties) ? 1 : 0,
            $professionLevels->getAgilityFirstLevelIncrement()
        );
        $this->assertSame(
            in_array('knack', $mainProperties) ? 1 : 0,
            $professionLevels->getKnackFirstLevelIncrement()
        );
        $this->assertSame(
            in_array('will', $mainProperties) ? 1 : 0,
            $professionLevels->getWillFirstLevelIncrement()
        );
        $this->assertSame(
            in_array('intelligence', $mainProperties) ? 1 : 0,
            $professionLevels->getIntelligenceFirstLevelIncrement()
        );
        $this->assertSame(
            in_array('charisma', $mainProperties) ? 1 : 0,
            $professionLevels->getCharismaFirstLevelIncrement()
        );
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function priest_level_can_be_added()
    {
        return $this->level_can_be_added('priest');
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends priest_level_can_be_added
     */
    public function priest_at_first_level_has_will_and_charisma_increment(ProfessionLevels $professionLevels)
    {
        $this->atFirstLevelHasIncrementOfMainProperties('priest', ['will', 'charisma'], $professionLevels);
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function ranger_level_can_be_added()
    {
        return $this->level_can_be_added('ranger');
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends ranger_level_can_be_added
     */
    public function ranger_at_first_level_has_strength_and_knack_increment(ProfessionLevels $professionLevels)
    {
        $this->atFirstLevelHasIncrementOfMainProperties('ranger', ['strength', 'knack'], $professionLevels);
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function theurgist_level_can_be_added()
    {
        return $this->level_can_be_added('theurgist');
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends theurgist_level_can_be_added
     */
    public function theurgist_at_first_level_has_intelligence_and_charisma_increment(ProfessionLevels $professionLevels)
    {
        $this->atFirstLevelHasIncrementOfMainProperties('theurgist', ['intelligence', 'charisma'], $professionLevels);
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function thief_level_can_be_added()
    {
        return $this->level_can_be_added('thief');
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends thief_level_can_be_added
     */
    public function thief_at_first_level_has_agility_and_knack_increment(ProfessionLevels $professionLevels)
    {
        $this->atFirstLevelHasIncrementOfMainProperties('thief', ['agility', 'knack'], $professionLevels);
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function wizard_level_can_be_added()
    {
        return $this->level_can_be_added('wizard');
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends wizard_level_can_be_added
     */
    public function wizard_at_first_level_has_will_and_intelligence_increment(ProfessionLevels $professionLevels)
    {
        $this->atFirstLevelHasIncrementOfMainProperties('wizard', ['will', 'intelligence'], $professionLevels);
    }

}
