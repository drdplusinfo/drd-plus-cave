<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Professions\Profession;
use DrdPlus\Cave\UnitBundle\Tests\Person\Skills\AbstractTestOfSkillPoint;

class PsychicalSkillPointTest extends AbstractTestOfSkillPoint
{
    /**
     * @test
     */
    public function I_can_create_skill_point_by_first_level_background_skills()
    {
        $psychicalSkillPoint = PsychicalSkillPoint::createByFirstLevelBackgroundSkills(
            $this->createProfessionFirstLevelLevelMock($this->mockery(Profession::class)),
            $backgroundSkills = $this->createBackgroundSkillsMock(123, 'getPsychicalSkillPoints')
        );
        $this->assertInstanceOf(PsychicalSkillPoint::class, $psychicalSkillPoint);
        $this->assertSame(1, $psychicalSkillPoint->getValue());
        $this->assertSame('psychical', $psychicalSkillPoint->getGroupName());
        $this->assertSame([Will::WILL, Intelligence::INTELLIGENCE], $psychicalSkillPoint->getRelatedProperties());
        $this->assertSame($backgroundSkills, $psychicalSkillPoint->getBackgroundSkills());
        $this->assertNull($psychicalSkillPoint->getFirstPaidSkillPoint());
        $this->assertNull($psychicalSkillPoint->getSecondPaidSkillPoint());
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_from_two_combined_skill_points()
    {
        $psychicalSkillPoint = PsychicalSkillPoint::createFromCrossGroupSkillPoints(
            $this->createProfessionFirstLevelLevelMock(),
            $firstPaidSkillPoint = $this->createCombinedSkillPointMock(),
            $secondPaidSkillPoint = $this->createCombinedSkillPointMock()
        );
        $this->assertInstanceOf(PsychicalSkillPoint::class, $psychicalSkillPoint);
        $this->assertNull($psychicalSkillPoint->getBackgroundSkills());
        $this->assertSame($firstPaidSkillPoint, $psychicalSkillPoint->getFirstPaidSkillPoint());
        $this->assertSame($secondPaidSkillPoint, $psychicalSkillPoint->getSecondPaidSkillPoint());
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_from_two_psychical_skill_points()
    {
        $psychicalSkillPoint = PsychicalSkillPoint::createFromCrossGroupSkillPoints(
            $this->createProfessionFirstLevelLevelMock(),
            $firstPaidSkillPoint = $this->createPsychicalSkillPointMock(),
            $secondPaidSkillPoint = $this->createPsychicalSkillPointMock()
        );
        $this->assertInstanceOf(PsychicalSkillPoint::class, $psychicalSkillPoint);
        $this->assertNull($psychicalSkillPoint->getBackgroundSkills());
        $this->assertSame($firstPaidSkillPoint, $psychicalSkillPoint->getFirstPaidSkillPoint());
        $this->assertSame($secondPaidSkillPoint, $psychicalSkillPoint->getSecondPaidSkillPoint());
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_from_physical_and_combined_skill_points()
    {
        $psychicalSkillPoint = PsychicalSkillPoint::createFromCrossGroupSkillPoints(
            $this->createProfessionFirstLevelLevelMock(),
            $firstPaidSkillPoint = $this->createPhysicalSkillPointMock(),
            $secondPaidSkillPoint = $this->createCombinedSkillPointMock()
        );
        $this->assertInstanceOf(PsychicalSkillPoint::class, $psychicalSkillPoint);
        $this->assertNull($psychicalSkillPoint->getBackgroundSkills());
        $this->assertSame($firstPaidSkillPoint, $psychicalSkillPoint->getFirstPaidSkillPoint());
        $this->assertSame($secondPaidSkillPoint, $psychicalSkillPoint->getSecondPaidSkillPoint());
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_by_level_with_will_increment()
    {
        $psychicalSkillPoint = PsychicalSkillPoint::createByRelatedPropertyIncrease(
            $this->createProfessionNextLevelLevelMock(1 /* will */)
        );
        $this->assertInstanceOf(PsychicalSkillPoint::class, $psychicalSkillPoint);
        $this->assertNull($psychicalSkillPoint->getBackgroundSkills());
        $this->assertNull($psychicalSkillPoint->getFirstPaidSkillPoint());
        $this->assertNull($psychicalSkillPoint->getSecondPaidSkillPoint());
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_by_level_with_intelligence_increment()
    {
        $psychicalSkillPoint = PsychicalSkillPoint::createByRelatedPropertyIncrease(
            $this->createProfessionNextLevelLevelMock(0 /* will */, 1 /* intelligence */)
        );
        $this->assertInstanceOf(PsychicalSkillPoint::class, $psychicalSkillPoint);
        $this->assertNull($psychicalSkillPoint->getBackgroundSkills());
        $this->assertNull($psychicalSkillPoint->getFirstPaidSkillPoint());
        $this->assertNull($psychicalSkillPoint->getSecondPaidSkillPoint());
    }

    /**
     * @param int $willIncrementSum = 0
     * @param int $intelligenceIncrementSum = 0
     *
     * @return \Mockery\MockInterface|ProfessionLevel
     */
    private function createProfessionNextLevelLevelMock($willIncrementSum = 0, $intelligenceIncrementSum = 0)
    {
        $professionLevel = $this->mockery(ProfessionLevel::class);
        $professionLevel->shouldReceive('isFirstLevel')
            ->atLeast()->once()
            ->andReturn(false);
        $professionLevel->shouldReceive('getWillIncrement')
            ->atLeast()->once()
            ->andReturn($willIncrement = $this->mockery(Will::class));
        $willIncrement->shouldReceive('getValue')
            ->atLeast()->once()
            ->andReturn($willIncrementSum);
        if ($intelligenceIncrementSum) {
            $professionLevel->shouldReceive('getIntelligenceIncrement')
                ->atLeast()->once()
                ->andReturn($intelligenceIncrement = $this->mockery(Intelligence::class));
            $intelligenceIncrement->shouldReceive('getValue')
                ->atLeast()->once()
                ->andReturn($intelligenceIncrementSum);
        }

        return $professionLevel;
    }

}
