<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Background\BackgroundSkills;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Professions\Profession;
use DrdPlus\Cave\UnitBundle\Person\Skills\Combined\CombinedSkillPoint;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\PsychicalSkillPoint;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

class PhysicalSkillPointTest extends TestWithMockery
{
    /**
     * @test
     */
    public function I_can_create_skill_point_by_first_level_background_skills()
    {
        $physicalSkillPoint = PhysicalSkillPoint::createByFirstLevelBackgroundSkills(
            $this->createProfessionFirstLevelLevelMock($this->mockery(Profession::class)),
            $backgroundSkills = $this->createBackgroundSkillPointsMock(1)
        );
        $this->assertInstanceOf(PhysicalSkillPoint::class, $physicalSkillPoint);
        $this->assertSame(1, $physicalSkillPoint->getValue());
        $this->assertSame('physical', $physicalSkillPoint->getGroupName());
        $this->assertSame([Strength::STRENGTH, Agility::AGILITY], $physicalSkillPoint->getRelatedProperties());
        $this->assertSame($backgroundSkills, $physicalSkillPoint->getBackgroundSkills());
        $this->assertNull($physicalSkillPoint->getFirstPaidSkillPoint());
        $this->assertNull($physicalSkillPoint->getSecondPaidSkillPoint());
    }

    /**
     * @param Profession|\Mockery\MockInterface $profession = null
     * @return \Mockery\MockInterface|ProfessionLevel
     */
    private function createProfessionFirstLevelLevelMock($profession = null)
    {
        $professionLevel = $this->mockery(ProfessionLevel::class);
        $professionLevel->shouldReceive('isFirstLevel')
            ->atLeast()->once()
            ->andReturn(true);
        if ($profession) {
            $professionLevel->shouldReceive('getProfession')
                ->atLeast()->once()
                ->andReturn($profession);
        }

        return $professionLevel;
    }

    /**
     * @param int $skillPoints
     * @return \Mockery\MockInterface|BackgroundSkills
     */
    private function createBackgroundSkillPointsMock($skillPoints)
    {
        $backgroundSKills = $this->mockery(BackgroundSkills::class);
        $backgroundSKills->shouldReceive('getPhysicalSkillPoints')
            ->with(\Mockery::type(Profession::class))
            ->atLeast()->once()
            ->andReturn($skillPoints);

        return $backgroundSKills;
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_from_two_combined_skill_points()
    {
        $physicalSkillPoint = PhysicalSkillPoint::createFromCrossGroupSkillPoints(
            $this->createProfessionFirstLevelLevelMock(),
            $firstPaidSkillPoint = $this->createCombinedSkillPointMock(),
            $secondPaidSkillPoint = $this->createCombinedSkillPointMock()
        );
        $this->assertInstanceOf(PhysicalSkillPoint::class, $physicalSkillPoint);
        $this->assertNull($physicalSkillPoint->getBackgroundSkills());
        $this->assertSame($firstPaidSkillPoint, $physicalSkillPoint->getFirstPaidSkillPoint());
        $this->assertSame($secondPaidSkillPoint, $physicalSkillPoint->getSecondPaidSkillPoint());
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_from_two_psychical_skill_points()
    {
        $physicalSkillPoint = PhysicalSkillPoint::createFromCrossGroupSkillPoints(
            $this->createProfessionFirstLevelLevelMock(),
            $firstPaidSkillPoint = $this->createPsychicalSkillPointMock(),
            $secondPaidSkillPoint = $this->createPsychicalSkillPointMock()
        );
        $this->assertInstanceOf(PhysicalSkillPoint::class, $physicalSkillPoint);
        $this->assertNull($physicalSkillPoint->getBackgroundSkills());
        $this->assertSame($firstPaidSkillPoint, $physicalSkillPoint->getFirstPaidSkillPoint());
        $this->assertSame($secondPaidSkillPoint, $physicalSkillPoint->getSecondPaidSkillPoint());
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_from_psychical_and_combined_skill_points()
    {
        $physicalSkillPoint = PhysicalSkillPoint::createFromCrossGroupSkillPoints(
            $this->createProfessionFirstLevelLevelMock(),
            $firstPaidSkillPoint = $this->createPsychicalSkillPointMock(),
            $secondPaidSkillPoint = $this->createCombinedSkillPointMock()
        );
        $this->assertInstanceOf(PhysicalSkillPoint::class, $physicalSkillPoint);
        $this->assertNull($physicalSkillPoint->getBackgroundSkills());
        $this->assertSame($firstPaidSkillPoint, $physicalSkillPoint->getFirstPaidSkillPoint());
        $this->assertSame($secondPaidSkillPoint, $physicalSkillPoint->getSecondPaidSkillPoint());
    }

    /**
     * @return \Mockery\MockInterface|CombinedSkillPoint
     */
    private function createCombinedSkillPointMock()
    {
        $combinedSkillPoint = $this->mockery(CombinedSkillPoint::class);
        $combinedSkillPoint->shouldReceive('getGroupName')
            ->atLeast()->once()
            ->andReturn('foo combined');

        return $combinedSkillPoint;
    }

    /**
     * @return \Mockery\MockInterface|PsychicalSkillPoint
     */
    private function createPsychicalSkillPointMock()
    {
        $psychicalSkillPoint = $this->mockery(PsychicalSkillPoint::class);
        $psychicalSkillPoint->shouldReceive('getGroupName')
            ->atLeast()->once()
            ->andReturn('bar psychical');

        return $psychicalSkillPoint;
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_by_level_with_strength_increment()
    {
        $physicalSkillPoint = PhysicalSkillPoint::createByRelatedPropertyIncrease(
            $this->createProfessionNextLevelLevelMock(1)
        );
        $this->assertInstanceOf(PhysicalSkillPoint::class, $physicalSkillPoint);
        $this->assertNull($physicalSkillPoint->getBackgroundSkills());
        $this->assertNull($physicalSkillPoint->getFirstPaidSkillPoint());
        $this->assertNull($physicalSkillPoint->getSecondPaidSkillPoint());
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_by_level_with_agility_increment()
    {
        $physicalSkillPoint = PhysicalSkillPoint::createByRelatedPropertyIncrease(
            $this->createProfessionNextLevelLevelMock(0 /* strength increment */, 1)
        );
        $this->assertInstanceOf(PhysicalSkillPoint::class, $physicalSkillPoint);
        $this->assertNull($physicalSkillPoint->getBackgroundSkills());
        $this->assertNull($physicalSkillPoint->getFirstPaidSkillPoint());
        $this->assertNull($physicalSkillPoint->getSecondPaidSkillPoint());
    }

    /**
     * @param int $strengthIncrementSum = 0
     * @param int $agilityIncrementSum = 0
     * @return \Mockery\MockInterface|ProfessionLevel
     */
    private function createProfessionNextLevelLevelMock($strengthIncrementSum = 0, $agilityIncrementSum = 0)
    {
        $professionLevel = $this->mockery(ProfessionLevel::class);
        $professionLevel->shouldReceive('isFirstLevel')
            ->atLeast()->once()
            ->andReturn(false);
        $professionLevel->shouldReceive('getStrengthIncrement')
            ->atLeast()->once()
            ->andReturn($strengthIncrement = $this->mockery(Strength::class));
        $strengthIncrement->shouldReceive('getValue')
            ->atLeast()->once()
            ->andReturn($strengthIncrementSum);
        if ($agilityIncrementSum) {
            $professionLevel->shouldReceive('getAgilityIncrement')
                ->atLeast()->once()
                ->andReturn($agilityIncrement = $this->mockery(Strength::class));
            $agilityIncrement->shouldReceive('getValue')
                ->atLeast()->once()
                ->andReturn($agilityIncrementSum);
        }

        return $professionLevel;
    }
}

