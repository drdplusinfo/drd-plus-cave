<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Professions\Profession;
use DrdPlus\Cave\UnitBundle\Tests\Person\Skills\AbstractTestOfSkillPoint;

class PhysicalSkillPointTest extends AbstractTestOfSkillPoint
{
    /**
     * @test
     */
    public function I_can_create_skill_point_by_first_level_background_skills()
    {
        $physicalSkillPoint = PhysicalSkillPoint::createByFirstLevelBackgroundSkills(
            $this->createProfessionFirstLevelLevelMock($this->mockery(Profession::class)),
            $backgroundSkills = $this->createBackgroundSkillsMock(123, 'getPhysicalSkillPoints')
        );
        $this->assertInstanceOf(PhysicalSkillPoint::class, $physicalSkillPoint);
        $this->assertSame(1, $physicalSkillPoint->getValue());
        $this->assertSame('physical', $physicalSkillPoint->getTypeName());
        $this->assertSame([Strength::STRENGTH, Agility::AGILITY], $physicalSkillPoint->getRelatedProperties());
        $this->assertSame($backgroundSkills, $physicalSkillPoint->getBackgroundSkills());
        $this->assertNull($physicalSkillPoint->getFirstPaidOtherSkillPoint());
        $this->assertNull($physicalSkillPoint->getSecondPaidOtherSkillPoint());
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
        $this->assertSame($firstPaidSkillPoint, $physicalSkillPoint->getFirstPaidOtherSkillPoint());
        $this->assertSame($secondPaidSkillPoint, $physicalSkillPoint->getSecondPaidOtherSkillPoint());
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
        $this->assertSame($firstPaidSkillPoint, $physicalSkillPoint->getFirstPaidOtherSkillPoint());
        $this->assertSame($secondPaidSkillPoint, $physicalSkillPoint->getSecondPaidOtherSkillPoint());
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
        $this->assertSame($firstPaidSkillPoint, $physicalSkillPoint->getFirstPaidOtherSkillPoint());
        $this->assertSame($secondPaidSkillPoint, $physicalSkillPoint->getSecondPaidOtherSkillPoint());
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_by_level_by_strength_increment()
    {
        $physicalSkillPoint = PhysicalSkillPoint::createByRelatedPropertyIncrease(
            $this->createProfessionNextLevelLevelMock(Strength::class)
        );
        $this->assertInstanceOf(PhysicalSkillPoint::class, $physicalSkillPoint);
        $this->assertNull($physicalSkillPoint->getBackgroundSkills());
        $this->assertNull($physicalSkillPoint->getFirstPaidOtherSkillPoint());
        $this->assertNull($physicalSkillPoint->getSecondPaidOtherSkillPoint());
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_by_level_by_agility_increment()
    {
        $physicalSkillPoint = PhysicalSkillPoint::createByRelatedPropertyIncrease(
            $this->createProfessionNextLevelLevelMock(Strength::class, Agility::class)
        );
        $this->assertInstanceOf(PhysicalSkillPoint::class, $physicalSkillPoint);
        $this->assertNull($physicalSkillPoint->getBackgroundSkills());
        $this->assertNull($physicalSkillPoint->getFirstPaidOtherSkillPoint());
        $this->assertNull($physicalSkillPoint->getSecondPaidOtherSkillPoint());
    }

}
