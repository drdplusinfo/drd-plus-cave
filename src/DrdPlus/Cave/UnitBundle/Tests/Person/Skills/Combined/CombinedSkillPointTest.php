<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
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
        $this->assertSame('combined', $combinedSkillPoint->getTypeName());
        $this->assertSame([Knack::KNACK, Charisma::CHARISMA], $combinedSkillPoint->getRelatedProperties());
        $this->assertSame($backgroundSkills, $combinedSkillPoint->getBackgroundSkills());
        $this->assertNull($combinedSkillPoint->getFirstPaidOtherSkillPoint());
        $this->assertNull($combinedSkillPoint->getSecondPaidOtherSkillPoint());
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
        $this->assertSame($firstPaidSkillPoint, $combinedSkillPoint->getFirstPaidOtherSkillPoint());
        $this->assertSame($secondPaidSkillPoint, $combinedSkillPoint->getSecondPaidOtherSkillPoint());
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
        $this->assertSame($firstPaidSkillPoint, $combinedSkillPoint->getFirstPaidOtherSkillPoint());
        $this->assertSame($secondPaidSkillPoint, $combinedSkillPoint->getSecondPaidOtherSkillPoint());
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
        $this->assertSame($firstPaidSkillPoint, $combinedSkillPoint->getFirstPaidOtherSkillPoint());
        $this->assertSame($secondPaidSkillPoint, $combinedSkillPoint->getSecondPaidOtherSkillPoint());
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_by_level_by_knack_increment()
    {
        $combinedSkillPoint = CombinedSkillPoint::createByRelatedPropertyIncrease(
            $this->createProfessionNextLevelLevelMock(Knack::class)
        );
        $this->assertInstanceOf(CombinedSkillPoint::class, $combinedSkillPoint);
        $this->assertNull($combinedSkillPoint->getBackgroundSkills());
        $this->assertNull($combinedSkillPoint->getFirstPaidOtherSkillPoint());
        $this->assertNull($combinedSkillPoint->getSecondPaidOtherSkillPoint());
    }

    /**
     * @test
     */
    public function I_can_create_skill_point_by_level_by_charisma_increment()
    {
        $combinedSkillPoint = CombinedSkillPoint::createByRelatedPropertyIncrease(
            $this->createProfessionNextLevelLevelMock(Knack::class, Charisma::class)
        );
        $this->assertInstanceOf(CombinedSkillPoint::class, $combinedSkillPoint);
        $this->assertNull($combinedSkillPoint->getBackgroundSkills());
        $this->assertNull($combinedSkillPoint->getFirstPaidOtherSkillPoint());
        $this->assertNull($combinedSkillPoint->getSecondPaidOtherSkillPoint());
    }

}
