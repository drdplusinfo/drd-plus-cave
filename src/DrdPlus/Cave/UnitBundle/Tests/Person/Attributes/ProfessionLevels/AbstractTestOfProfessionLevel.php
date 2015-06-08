<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\ProfessionLevels;

use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\LevelValue;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

class AbstractTestOfProfessionLevel extends TestWithMockery
{

    /**
     * @return ProfessionLevel
     *
     * @test
     */
    public function can_create_instance()
    {
        /** @var LevelValue|\Mockery\MockInterface $levelValue */
        $levelValue = \Mockery::mock(LevelValue::class);
        $levelValue->shouldReceive('getValue')
            ->andReturn(1);
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
    public function has_not_set_id_on_creation(ProfessionLevel $professionLevel)
    {
        $this->assertNull($professionLevel->getId());
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function time_of_level_up_is_creation_time()
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
        /** @var ProfessionLevel $professionLevel */
        $professionLevel = new $professionLevelClass(
            $levelValue,
            $strengthIncrement,
            $agilityIncrement,
            $knackIncrement,
            $intelligenceIncrement,
            $charismaIncrement,
            $willIncrement
        );
        $this->assertEquals(time(), $professionLevel->getLevelUpAt()->getTimestamp());
    }

    /**
     * @param ProfessionLevel $professionLevel
     *
     * @test
     * @depends can_create_instance
     */
    public function gives_expected_profession_code(ProfessionLevel $professionLevel)
    {
        $class = $this->getProfessionLevelClass();
        // like /projects/drd/plus/cave/src/DrdPlus/Cave/UnitBundle/Person/Attributes/ProfessionLevels/FighterLevel.php = Fighter
        $baseName = preg_replace('~(\w+\\\)*(\w+)Level~', '$2', $class);
        $underscored = preg_replace('~(\w)([A-Z])~', '$1_$2', $baseName);
        $lowered = strtolower($underscored);

        $this->assertSame($lowered, $professionLevel->getProfession()->getName());
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function gives_given_parameters()
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
        /** @var ProfessionLevel $professionLevel */
        $professionLevel = new $professionLevelClass(
            $levelValue,
            $strengthIncrement,
            $agilityIncrement,
            $knackIncrement,
            $intelligenceIncrement,
            $charismaIncrement,
            $willIncrement,
            $levelUpAt = new \DateTimeImmutable()
        );
        $this->assertSame($levelValue, $professionLevel->getLevelValue());
        $this->assertSame($strengthIncrement, $professionLevel->getStrengthIncrement());
        $this->assertSame($agilityIncrement, $professionLevel->getAgilityIncrement());
        $this->assertSame($knackIncrement, $professionLevel->getKnackIncrement());
        $this->assertSame($intelligenceIncrement, $professionLevel->getIntelligenceIncrement());
        $this->assertSame($charismaIncrement, $professionLevel->getCharismaIncrement());
        $this->assertSame($willIncrement, $professionLevel->getWillIncrement());
        $this->assertSame($levelUpAt, $professionLevel->getLevelUpAt());
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
