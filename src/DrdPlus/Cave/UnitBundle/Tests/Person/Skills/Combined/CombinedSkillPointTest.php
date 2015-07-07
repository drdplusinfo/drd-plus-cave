<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Background\BackgroundSkills;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Professions\Profession;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

class CombinedSkillPointTest extends TestWithMockery
{
    /**
     * @test
     */
    public function I_can_create_skill_point_from_first_level_background_skills()
    {
        $combinedSkillPoint = CombinedSkillPoint::createByFirstLevelBackgroundSkills(
            $this->createProfessionLevelMock(),
            $this->createBackgroundSkillPointsMock(1)
        );
        $this->assertInstanceOf(CombinedSkillPoint::class, $combinedSkillPoint);
        $this->assertSame(1, $combinedSkillPoint->getValue());
        $this->assertSame('combined', $combinedSkillPoint->getGroupName());
        $this->assertSame([Knack::KNACK, Charisma::CHARISMA], $combinedSkillPoint->getRelatedProperties());
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
        $backgroundSKills->shouldReceive('getCombinedSkillPoints')
            ->with(\Mockery::type(Profession::class))
            ->atLeast()->once()
            ->andReturn($skillPoints);

        return $backgroundSKills;
    }
}

