<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Background\BackgroundSkills;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Professions\Profession;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

class PhysicalSkillPointTest extends TestWithMockery
{
    /**
     * @test
     */
    public function I_can_create_skill_point_from_first_level_background_skills()
    {
        $physicalSkillPoint = PhysicalSkillPoint::createByFirstLevelBackgroundSkills(
            $this->createProfessionLevelMock(),
            $this->createBackgroundSkillPointsMock(1)
        );
        $this->assertInstanceOf(PhysicalSkillPoint::class, $physicalSkillPoint);
        $this->assertSame(1, $physicalSkillPoint->getValue());
        $this->assertSame('physical', $physicalSkillPoint->getGroupName());
        $this->assertSame([Strength::STRENGTH, Agility::AGILITY], $physicalSkillPoint->getRelatedProperties());
    }

    /**
     * @return \Mockery\MockInterface|ProfessionLevel
     */
    private function createProfessionLevelMock()
    {
        $professionLevel = $this->mockery(ProfessionLevel::class);
        $professionLevel->shouldReceive('isFirstLevel')
            ->atLeast()->once()
            ->andReturn(true);
        $professionLevel->shouldReceive('getProfession')
            ->atLeast()->once()
            ->andReturn($this->mockery(Profession::class));

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
}

