<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\ProfessionLevels;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\LevelValue;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Will;

class AbstractTestOfProfessionLevel extends \PHPUnit_Framework_TestCase
{

    /**
     * @return ProfessionLevel
     *
     * @test
     */
    public function can_create_instance()
    {
        /** @var LevelValue $levelValue */
        $levelValue = \Mockery::mock(LevelValue::class);
        /** @var Strength $strengthIncrement */
        $strengthIncrement = \Mockery::mock(Strength::class);
        /** @var Agility $agilityIncrement */
        $agilityIncrement = \Mockery::mock(Agility::class);
        /** @var Knack $knackIncrement */
        $knackIncrement = \Mockery::mock(Knack::class);
        /** @var Intelligence $intelligenceIncrement */
        $intelligenceIncrement = \Mockery::mock(Intelligence::class);
        /** @var Charisma $charismaIncrement */
        $charismaIncrement = \Mockery::mock(Charisma::class);
        /** @var Will $willIncrement */
        $willIncrement = \Mockery::mock(Will::class);
        $professionLevelClass = $this->getProfessionLevelClass();
        $instance = new $professionLevelClass(
            $levelValue,
            $strengthIncrement,
            $agilityIncrement,
            $knackIncrement,
            $intelligenceIncrement,
            $charismaIncrement,
            $willIncrement
        );
        $this->assertInstanceOf($this->getProfessionLevelClass(), $instance);

        return $instance;
    }

    /**
     * @return string|ProfessionLevel
     */
    private function getProfessionLevelClass()
    {
        return preg_replace('~Test$~', '', static::class);
    }

    /**
     * @param ProfessionLevel $professionLevel
     *
     * @test
     * @depends can_create_instance
     */
    public function gives_proper_strength_first_level_modifier(ProfessionLevel $professionLevel)
    {
        $this->assertSame($this->getStrengthFirstLevelModifier(), $professionLevel->getStrengthFirstLevelModifier());
    }

    protected function getStrengthFirstLevelModifier()
    {
        return 0;
    }

    /**
     * @param ProfessionLevel $professionLevel
     *
     * @test
     * @depends can_create_instance
     */
    public function gives_proper_agility_first_level_modifier(ProfessionLevel $professionLevel)
    {
        $this->assertSame($this->getAgilityFirstLevelModifier(), $professionLevel->getAgilityFirstLevelModifier());
    }

    protected function getAgilityFirstLevelModifier()
    {
        return 0;
    }

    /**
     * @param ProfessionLevel $professionLevel
     *
     * @test
     * @depends can_create_instance
     */
    public function gives_proper_knack_first_level_modifier(ProfessionLevel $professionLevel)
    {
        $this->assertSame($this->getKnackFirstLevelModifier(), $professionLevel->getKnackFirstLevelModifier());
    }

    protected function getKnackFirstLevelModifier()
    {
        return 0;
    }

    /**
     * @param ProfessionLevel $professionLevel
     *
     * @test
     * @depends can_create_instance
     */
    public function gives_proper_charisma_first_level_modifier(ProfessionLevel $professionLevel)
    {
        $this->assertSame($this->getCharismaFirstLevelModifier(), $professionLevel->getCharismaFirstLevelModifier());
    }

    protected function getCharismaFirstLevelModifier()
    {
        return 0;
    }

    /**
     * @param ProfessionLevel $professionLevel
     *
     * @test
     * @depends can_create_instance
     */
    public function gives_proper_intelligence_first_level_modifier(ProfessionLevel $professionLevel)
    {
        $this->assertSame($this->getIntelligenceFirstLevelModifier(), $professionLevel->getIntelligenceFirstLevelModifier());
    }

    protected function getIntelligenceFirstLevelModifier()
    {
        return 0;
    }

    /**
     * @param ProfessionLevel $professionLevel
     *
     * @test
     * @depends can_create_instance
     */
    public function gives_proper_will_first_level_modifier(ProfessionLevel $professionLevel)
    {
        $this->assertSame($this->getWillFirstLevelModifier(), $professionLevel->getWillFirstLevelModifier());
    }

    protected function getWillFirstLevelModifier()
    {
        return 0;
    }

}
