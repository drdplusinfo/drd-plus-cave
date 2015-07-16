<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
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
        $this->assertSame('psychical', $psychicalSkillPoint->getTypeName());
        $this->assertSame([Will::WILL, Intelligence::INTELLIGENCE], $psychicalSkillPoint->getRelatedProperties());
        $this->assertSame($backgroundSkills, $psychicalSkillPoint->getBackgroundSkills());
        $this->assertNull($psychicalSkillPoint->getFirstPaidOtherSkillPoint());
        $this->assertNull($psychicalSkillPoint->getSecondPaidOtherSkillPoint());
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
        $this->assertSame($firstPaidSkillPoint, $psychicalSkillPoint->getFirstPaidOtherSkillPoint());
        $this->assertSame($secondPaidSkillPoint, $psychicalSkillPoint->getSecondPaidOtherSkillPoint());
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_from_two_physical_skill_points()
    {
        $psychicalSkillPoint = PsychicalSkillPoint::createFromCrossGroupSkillPoints(
            $this->createProfessionFirstLevelLevelMock(),
            $firstPaidSkillPoint = $this->createPhysicalSkillPointMock(),
            $secondPaidSkillPoint = $this->createPhysicalSkillPointMock()
        );
        $this->assertInstanceOf(PsychicalSkillPoint::class, $psychicalSkillPoint);
        $this->assertNull($psychicalSkillPoint->getBackgroundSkills());
        $this->assertSame($firstPaidSkillPoint, $psychicalSkillPoint->getFirstPaidOtherSkillPoint());
        $this->assertSame($secondPaidSkillPoint, $psychicalSkillPoint->getSecondPaidOtherSkillPoint());
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
        $this->assertSame($firstPaidSkillPoint, $psychicalSkillPoint->getFirstPaidOtherSkillPoint());
        $this->assertSame($secondPaidSkillPoint, $psychicalSkillPoint->getSecondPaidOtherSkillPoint());
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_by_level_by_will_increment()
    {
        $psychicalSkillPoint = PsychicalSkillPoint::createByRelatedPropertyIncrease(
            $this->createProfessionNextLevelLevelMock(Will::class)
        );
        $this->assertInstanceOf(PsychicalSkillPoint::class, $psychicalSkillPoint);
        $this->assertNull($psychicalSkillPoint->getBackgroundSkills());
        $this->assertNull($psychicalSkillPoint->getFirstPaidOtherSkillPoint());
        $this->assertNull($psychicalSkillPoint->getSecondPaidOtherSkillPoint());
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_by_level_by_intelligence_increment()
    {
        $psychicalSkillPoint = PsychicalSkillPoint::createByRelatedPropertyIncrease(
            $this->createProfessionNextLevelLevelMock(Will::class, Intelligence::class)
        );
        $this->assertInstanceOf(PsychicalSkillPoint::class, $psychicalSkillPoint);
        $this->assertNull($psychicalSkillPoint->getBackgroundSkills());
        $this->assertNull($psychicalSkillPoint->getFirstPaidOtherSkillPoint());
        $this->assertNull($psychicalSkillPoint->getSecondPaidOtherSkillPoint());
    }

}
