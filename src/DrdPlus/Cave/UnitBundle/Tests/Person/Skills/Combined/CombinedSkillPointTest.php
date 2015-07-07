<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Professions\Profession;
use DrdPlus\Cave\UnitBundle\Tests\Person\Skills\AbstractTestOfSkillPoint;

class CombinedSkillPointTest extends AbstractTestOfSkillPoint
{
    /**
     * @test
     */
    public function I_can_create_skill_point_by_first_level_background_skills()
    {
        $combinedSkillPoint = CombinedSkillPoint::createByFirstLevelBackgroundSkills(
            $this->createProfessionFirstLevelLevelMock($this->mockery(Profession::class)),
            $backgroundSkills = $this->createBackgroundSkillsMock(123, 'getCombinedSkillPoints')
        );
        $this->assertInstanceOf(CombinedSkillPoint::class, $combinedSkillPoint);
        $this->assertSame(1, $combinedSkillPoint->getValue());
        $this->assertSame('combined', $combinedSkillPoint->getGroupName());
        $this->assertSame([Knack::KNACK, Charisma::CHARISMA], $combinedSkillPoint->getRelatedProperties());
        $this->assertSame($backgroundSkills, $combinedSkillPoint->getBackgroundSkills());
        $this->assertNull($combinedSkillPoint->getFirstPaidSkillPoint());
        $this->assertNull($combinedSkillPoint->getSecondPaidSkillPoint());
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_from_two_physical_skill_points()
    {
        $combinedSkillPoint = CombinedSkillPoint::createFromCrossGroupSkillPoints(
            $this->createProfessionFirstLevelLevelMock(),
            $firstPaidSkillPoint = $this->createPhysicalSkillPointMock(),
            $secondPaidSkillPoint = $this->createPhysicalSkillPointMock()
        );
        $this->assertInstanceOf(CombinedSkillPoint::class, $combinedSkillPoint);
        $this->assertNull($combinedSkillPoint->getBackgroundSkills());
        $this->assertSame($firstPaidSkillPoint, $combinedSkillPoint->getFirstPaidSkillPoint());
        $this->assertSame($secondPaidSkillPoint, $combinedSkillPoint->getSecondPaidSkillPoint());
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_from_two_psychical_skill_points()
    {
        $combinedSkillPoint = CombinedSkillPoint::createFromCrossGroupSkillPoints(
            $this->createProfessionFirstLevelLevelMock(),
            $firstPaidSkillPoint = $this->createPsychicalSkillPointMock(),
            $secondPaidSkillPoint = $this->createPsychicalSkillPointMock()
        );
        $this->assertInstanceOf(CombinedSkillPoint::class, $combinedSkillPoint);
        $this->assertNull($combinedSkillPoint->getBackgroundSkills());
        $this->assertSame($firstPaidSkillPoint, $combinedSkillPoint->getFirstPaidSkillPoint());
        $this->assertSame($secondPaidSkillPoint, $combinedSkillPoint->getSecondPaidSkillPoint());
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_from_psychical_and_physical_skill_points()
    {
        $combinedSkillPoint = CombinedSkillPoint::createFromCrossGroupSkillPoints(
            $this->createProfessionFirstLevelLevelMock(),
            $firstPaidSkillPoint = $this->createPsychicalSkillPointMock(),
            $secondPaidSkillPoint = $this->createPhysicalSkillPointMock()
        );
        $this->assertInstanceOf(CombinedSkillPoint::class, $combinedSkillPoint);
        $this->assertNull($combinedSkillPoint->getBackgroundSkills());
        $this->assertSame($firstPaidSkillPoint, $combinedSkillPoint->getFirstPaidSkillPoint());
        $this->assertSame($secondPaidSkillPoint, $combinedSkillPoint->getSecondPaidSkillPoint());
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_by_level_with_strength_increment()
    {
        $combinedSkillPoint = CombinedSkillPoint::createByRelatedPropertyIncrease(
            $this->createProfessionNextLevelLevelMock(1 /* knack increment */)
        );
        $this->assertInstanceOf(CombinedSkillPoint::class, $combinedSkillPoint);
        $this->assertNull($combinedSkillPoint->getBackgroundSkills());
        $this->assertNull($combinedSkillPoint->getFirstPaidSkillPoint());
        $this->assertNull($combinedSkillPoint->getSecondPaidSkillPoint());
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_by_level_with_agility_increment()
    {
        $combinedSkillPoint = CombinedSkillPoint::createByRelatedPropertyIncrease(
            $this->createProfessionNextLevelLevelMock(0 /* knack increment */, 1 /* charisma increment */)
        );
        $this->assertInstanceOf(CombinedSkillPoint::class, $combinedSkillPoint);
        $this->assertNull($combinedSkillPoint->getBackgroundSkills());
        $this->assertNull($combinedSkillPoint->getFirstPaidSkillPoint());
        $this->assertNull($combinedSkillPoint->getSecondPaidSkillPoint());
    }

    /**
     * @param int $knackIncrementSum = 0
     * @param int $charismaIncrementSum = 0
     *
     * @return \Mockery\MockInterface|ProfessionLevel
     */
    private function createProfessionNextLevelLevelMock($knackIncrementSum = 0, $charismaIncrementSum = 0)
    {
        $professionLevel = $this->mockery(ProfessionLevel::class);
        $professionLevel->shouldReceive('isFirstLevel')
            ->atLeast()->once()
            ->andReturn(false);
        $professionLevel->shouldReceive('getKnackIncrement')
            ->atLeast()->once()
            ->andReturn($knackIncrement = $this->mockery(Knack::class));
        $knackIncrement->shouldReceive('getValue')
            ->atLeast()->once()
            ->andReturn($knackIncrementSum);
        if ($charismaIncrementSum) {
            $professionLevel->shouldReceive('getCharismaIncrement')
                ->atLeast()->once()
                ->andReturn($charismaIncrement = $this->mockery(Charisma::class));
            $charismaIncrement->shouldReceive('getValue')
                ->atLeast()->once()
                ->andReturn($charismaIncrementSum);
        }

        return $professionLevel;
    }
}
