<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Person\Background\BackgroundSkills;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Professions\Profession;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

class PsychicalSkillPointTest extends TestWithMockery
{
    /**
     * @test
     */
    public function I_can_create_skill_point_from_first_level_background_skills()
    {
        $psychicalSkillPoint = PsychicalSkillPoint::createByFirstLevelBackgroundSkills(
            $this->createProfessionLevelMock(),
            $this->createBackgroundSkillPointsMock(1)
        );
        $this->assertInstanceOf(PsychicalSkillPoint::class, $psychicalSkillPoint);
        $this->assertSame(1, $psychicalSkillPoint->getValue());
        $this->assertSame('psychical', $psychicalSkillPoint->getGroupName());
        $this->assertSame([Will::WILL, Intelligence::INTELLIGENCE], $psychicalSkillPoint->getRelatedProperties());
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
        $backgroundSKills->shouldReceive('getPsychicalSkillPoints')
            ->with(\Mockery::type(Profession::class))
            ->atLeast()->once()
            ->andReturn($skillPoints);

        return $backgroundSKills;
    }
}

