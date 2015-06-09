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
        $professionLevel->shouldReceive('getProfession')
            ->andReturn($profession = \Mockery::mock(Profession::class));
        $profession->shouldReceive('getName')
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
        $this->askFirstLevelForPrimaryPropertiesIncrement(Fighter::FIGHTER, $professionLevels);
    }

    private function askFirstLevelForPrimaryPropertiesIncrement(
        $professionName,
        ProfessionLevels $professionLevels
    )
    {
        /** @var ProfessionLevelsTest|ProfessionLevelsTestFirstLevelsTrait $this */
        /** @var FighterLevel|\Mockery\MockInterface $firstLevel */
        $firstLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf($this->getFirstLevelsProfessionLevelClass($professionName), $firstLevel);
        foreach ([Strength::STRENGTH, Agility::AGILITY, Knack::KNACK, Will::WILL, Intelligence::INTELLIGENCE, Charisma::CHARISMA] as $propertyName) {
            $firstLevel->shouldReceive('get' . ucfirst($propertyName) . 'Increment')
                ->atLeast()->once()
                ->andReturn($increment = \Mockery::mock(BaseProperty::class));
            $increment->shouldReceive('getValue')
                ->atLeast()->once()
                ->andReturn($this->isPrimaryProperty_FirstLevels($propertyName, $professionName) ? ProfessionLevel::PROPERTY_FIRST_LEVEL_MODIFIER : 0);
        }
        $professionLevels->getStrengthModifierForFirstLevel();
        $professionLevels->getAgilityModifierForFirstLevel();
        $professionLevels->getKnackModifierForFirstLevel();
        $professionLevels->getWillModifierForFirstLevel();
        $professionLevels->getIntelligenceModifierForFirstLevel();
        $professionLevels->getCharismaModifierForFirstLevel();
    }

    /**
     * @param string $propertyName
     * @param string $professionName
     *
     * @return bool
     */
    private function isPrimaryProperty_FirstLevels($propertyName, $professionName)
    {
        return in_array($propertyName, $this->getPrimaryProperties_FirstLevels($professionName));
    }

    private function getPrimaryProperties_FirstLevels($professionName)
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
        $professionLevel->shouldReceive('getProfession')
            ->andReturn($profession = \Mockery::mock(Profession::class));
        $profession->shouldReceive('getName')
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
        $this->askFirstLevelForPrimaryPropertiesIncrement('priest', $professionLevels);
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
        $this->askFirstLevelForPrimaryPropertiesIncrement('ranger', $professionLevels);
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
        $this->askFirstLevelForPrimaryPropertiesIncrement('theurgist', $professionLevels);
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
        $this->askFirstLevelForPrimaryPropertiesIncrement('thief', $professionLevels);
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
        $this->askFirstLevelForPrimaryPropertiesIncrement('wizard', $professionLevels);
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
