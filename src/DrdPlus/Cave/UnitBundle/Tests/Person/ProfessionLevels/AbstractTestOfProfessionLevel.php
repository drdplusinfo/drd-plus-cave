<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\ProfessionLevels;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body\WeightInKg;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\LevelValue;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Professions\Profession;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;
use Mockery\MockInterface;

abstract class AbstractTestOfProfessionLevel extends TestWithMockery
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
        /** @var Strength|\Mockery\MockInterface $strengthIncrement */
        $strengthIncrement = \Mockery::mock(Strength::class);
        $this->addPropertyFirstLevelExpectation($strengthIncrement, Strength::STRENGTH);
        /** @var Agility|\Mockery\MockInterface $agilityIncrement */
        $agilityIncrement = \Mockery::mock(Agility::class);
        $this->addPropertyFirstLevelExpectation($agilityIncrement, Agility::AGILITY);
        /** @var Knack|\Mockery\MockInterface $knackIncrement */
        $knackIncrement = \Mockery::mock(Knack::class);
        $this->addPropertyFirstLevelExpectation($knackIncrement, Knack::KNACK);
        /** @var Will|\Mockery\MockInterface $willIncrement */
        $willIncrement = \Mockery::mock(Will::class);
        $this->addPropertyFirstLevelExpectation($willIncrement, Will::WILL);
        /** @var Intelligence|\Mockery\MockInterface $intelligenceIncrement */
        $intelligenceIncrement = \Mockery::mock(Intelligence::class);
        $this->addPropertyFirstLevelExpectation($intelligenceIncrement, Intelligence::INTELLIGENCE);
        /** @var Charisma|\Mockery\MockInterface $charismaIncrement */
        $charismaIncrement = \Mockery::mock(Charisma::class);
        $this->addPropertyFirstLevelExpectation($charismaIncrement, Charisma::CHARISMA);
        /** @var WeightInKg|\Mockery\MockInterface $weightInKg */
        $weightInKg = \Mockery::mock(WeightInKg::class);
        $professionLevelClass = $this->getProfessionLevelClass();
        $instance = new $professionLevelClass(
            $this->createProfessionMock(),
            $levelValue,
            $strengthIncrement,
            $agilityIncrement,
            $knackIncrement,
            $willIncrement,
            $intelligenceIncrement,
            $charismaIncrement,
            $weightInKg
        );
        $this->assertInstanceOf($this->getProfessionLevelClass(), $instance);

        return $instance;
    }

    private function addPropertyFirstLevelExpectation(MockInterface $property, $propertyName)
    {
        $property->shouldReceive('getValue')
            ->atLeast()->once()
            ->andReturn($this->isPrimaryProperty($propertyName) ? 1 : 0);
        $property->shouldReceive('getCode')
            ->atLeast()->once()
            ->andReturn($propertyName);
    }

    /**
     * @param string $propertyName
     *
     * @return bool
     */
    private function isPrimaryProperty($propertyName)
    {
        return in_array($propertyName, $this->getPrimaryProperties());
    }

    /**
     * @return string[]
     */
    abstract protected function getPrimaryProperties();

    /**
     * @return MockInterface|Profession
     */
    private function createProfessionMock()
    {
        $profession = \Mockery::mock($this->getProfessionClass());
        $profession->shouldReceive('getPrimaryPropertyCodes')
            ->atLeast()->once()
            ->andReturn($this->getPrimaryProperties());
        $profession->shouldReceive('getName')
            ->andReturn($this->getProfessionCode());

        return $profession;
    }

    /**
     * @return string
     */
    private function getProfessionCode()
    {
        return strtolower(preg_replace('~^.+\\\~', '', $this->getProfessionClass()));
    }

    /**
     * @return string|Profession
     */
    private function getProfessionClass()
    {
        $withProperNamespace = preg_replace('~LevelTest$~', '', static::class);

        return preg_replace('~ProfessionLevels~', 'Professions', $withProperNamespace);
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
        /** @var LevelValue|\Mockery\MockInterface $levelValue */
        $levelValue = \Mockery::mock(LevelValue::class);
        $levelValue->shouldReceive('getValue')
            ->andReturn(1);
        /** @var Strength|\Mockery\MockInterface $strengthIncrement */
        $strengthIncrement = \Mockery::mock(Strength::class);
        $this->addPropertyFirstLevelExpectation($strengthIncrement, Strength::STRENGTH);
        /** @var Agility|\Mockery\MockInterface $agilityIncrement */
        $agilityIncrement = \Mockery::mock(Agility::class);
        $this->addPropertyFirstLevelExpectation($agilityIncrement, Agility::AGILITY);
        /** @var Knack|\Mockery\MockInterface $knackIncrement */
        $knackIncrement = \Mockery::mock(Knack::class);
        $this->addPropertyFirstLevelExpectation($knackIncrement, Knack::KNACK);
        /** @var Will|\Mockery\MockInterface $willIncrement */
        $willIncrement = \Mockery::mock(Will::class);
        $this->addPropertyFirstLevelExpectation($willIncrement, Will::WILL);
        /** @var Intelligence|\Mockery\MockInterface $intelligenceIncrement */
        $intelligenceIncrement = \Mockery::mock(Intelligence::class);
        $this->addPropertyFirstLevelExpectation($intelligenceIncrement, Intelligence::INTELLIGENCE);
        /** @var Charisma|\Mockery\MockInterface $charismaIncrement */
        $charismaIncrement = \Mockery::mock(Charisma::class);
        $this->addPropertyFirstLevelExpectation($charismaIncrement, Charisma::CHARISMA);
        /** @var WeightInKg|\Mockery\MockInterface $weightInKg */
        $weightInKg = \Mockery::mock(WeightInKg::class);
        $professionLevelClass = $this->getProfessionLevelClass();
        /** @var ProfessionLevel $professionLevel */
        $professionLevel = new $professionLevelClass(
            $this->createProfessionMock(),
            $levelValue,
            $strengthIncrement,
            $agilityIncrement,
            $knackIncrement,
            $willIncrement,
            $intelligenceIncrement,
            $charismaIncrement,
            $weightInKg
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
    public function returns_given_parameters()
    {
        /** @var LevelValue|\Mockery\MockInterface $levelValue */
        $levelValue = \Mockery::mock(LevelValue::class);
        $levelValue->shouldReceive('getValue')
            ->andReturn(1);
        /** @var Strength|\Mockery\MockInterface $strengthIncrement */
        $strengthIncrement = \Mockery::mock(Strength::class);
        $this->addPropertyFirstLevelExpectation($strengthIncrement, Strength::STRENGTH);
        /** @var Agility|\Mockery\MockInterface $agilityIncrement */
        $agilityIncrement = \Mockery::mock(Agility::class);
        $this->addPropertyFirstLevelExpectation($agilityIncrement, Agility::AGILITY);
        /** @var Knack|\Mockery\MockInterface $knackIncrement */
        $knackIncrement = \Mockery::mock(Knack::class);
        $this->addPropertyFirstLevelExpectation($knackIncrement, Knack::KNACK);
        /** @var Will|\Mockery\MockInterface $willIncrement */
        $willIncrement = \Mockery::mock(Will::class);
        $this->addPropertyFirstLevelExpectation($willIncrement, Will::WILL);
        /** @var Intelligence|\Mockery\MockInterface $intelligenceIncrement */
        $intelligenceIncrement = \Mockery::mock(Intelligence::class);
        $this->addPropertyFirstLevelExpectation($intelligenceIncrement, Intelligence::INTELLIGENCE);
        /** @var Charisma|\Mockery\MockInterface $charismaIncrement */
        $charismaIncrement = \Mockery::mock(Charisma::class);
        $this->addPropertyFirstLevelExpectation($charismaIncrement, Charisma::CHARISMA);
        /** @var WeightInKg|\Mockery\MockInterface $weightInKg */
        $weightInKg = \Mockery::mock(WeightInKg::class);
        $professionLevelClass = $this->getProfessionLevelClass();
        /** @var ProfessionLevel $professionLevel */
        $professionLevel = new $professionLevelClass(
            $this->createProfessionMock(),
            $levelValue,
            $strengthIncrement,
            $agilityIncrement,
            $knackIncrement,
            $willIncrement,
            $intelligenceIncrement,
            $charismaIncrement,
            $weightInKg,
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
        $this->assertSame($this->getStrengthFirstLevelModifier(), $professionLevel->getStrengthIncrement()->getValue());
    }

    protected function getStrengthFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Strength::STRENGTH);
    }

    private function getPropertyFirstLevelModifier($propertyName)
    {
        return $this->isPrimaryProperty($propertyName)
            ? 1
            : 0;
    }

    /**
     * @param ProfessionLevel $professionLevel
     *
     * @test
     * @depends can_create_instance
     */
    public function gives_proper_agility_first_level_modifier(ProfessionLevel $professionLevel)
    {
        $this->assertSame($this->getAgilityFirstLevelModifier(), $professionLevel->getAgilityIncrement()->getValue());
    }

    protected function getAgilityFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Agility::AGILITY);
    }

    /**
     * @param ProfessionLevel $professionLevel
     *
     * @test
     * @depends can_create_instance
     */
    public function gives_proper_knack_first_level_modifier(ProfessionLevel $professionLevel)
    {
        $this->assertSame($this->getKnackFirstLevelModifier(), $professionLevel->getKnackIncrement()->getValue());
    }

    protected function getKnackFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Knack::KNACK);
    }

    /**
     * @param ProfessionLevel $professionLevel
     *
     * @test
     * @depends can_create_instance
     */
    public function gives_proper_charisma_first_level_modifier(ProfessionLevel $professionLevel)
    {
        $this->assertSame($this->getCharismaFirstLevelModifier(), $professionLevel->getCharismaIncrement()->getValue());
    }

    protected function getCharismaFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Charisma::CHARISMA);
    }

    /**
     * @param ProfessionLevel $professionLevel
     *
     * @test
     * @depends can_create_instance
     */
    public function gives_proper_intelligence_first_level_modifier(ProfessionLevel $professionLevel)
    {
        $this->assertSame($this->getIntelligenceFirstLevelModifier(), $professionLevel->getIntelligenceIncrement()->getValue());
    }

    protected function getIntelligenceFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Intelligence::INTELLIGENCE);
    }

    /**
     * @param ProfessionLevel $professionLevel
     *
     * @test
     * @depends can_create_instance
     */
    public function gives_proper_will_first_level_modifier(ProfessionLevel $professionLevel)
    {
        $this->assertSame($this->getWillFirstLevelModifier(), $professionLevel->getWillIncrement()->getValue());
    }

    protected function getWillFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Will::WILL);
    }

}
