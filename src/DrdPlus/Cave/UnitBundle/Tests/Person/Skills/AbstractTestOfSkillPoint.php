<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Skills;

use DrdPlus\Cave\UnitBundle\Person\Background\BackgroundSkills;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Professions\Profession;
use DrdPlus\Cave\UnitBundle\Person\Skills\Combined\CombinedSkillPoint;
use DrdPlus\Cave\UnitBundle\Person\Skills\Physical\PhysicalSkillPoint;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\PsychicalSkillPoint;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

abstract class AbstractTestOfSkillPoint extends TestWithMockery
{
    abstract public function I_can_create_skill_point_by_first_level_background_skills();

    /**
     * @param Profession|\Mockery\MockInterface $profession = null
     *
     * @return \Mockery\MockInterface|ProfessionLevel
     */
    protected function createProfessionFirstLevelLevelMock($profession = null)
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
     * @param int $skillPointsValue
     * @param string $getterName
     *
     * @return \Mockery\MockInterface|BackgroundSkills
     */
    protected function createBackgroundSkillsMock($skillPointsValue, $getterName)
    {
        $backgroundSKills = $this->mockery(BackgroundSkills::class);
        $backgroundSKills->shouldReceive($getterName)
            ->with(\Mockery::type(Profession::class))
            ->atLeast()->once()
            ->andReturn($skillPointsValue);

        return $backgroundSKills;
    }

    /**
     * @return \Mockery\MockInterface|PhysicalSkillPoint
     */
    protected function createPhysicalSkillPointMock()
    {
        $physicalSkillPoint = $this->mockery(PhysicalSkillPoint::class);
        $physicalSkillPoint->shouldReceive('getGroupName')
            ->atLeast()->once()
            ->andReturn('foo physical');

        return $physicalSkillPoint;
    }

    /**
     * @return \Mockery\MockInterface|CombinedSkillPoint
     */
    protected function createCombinedSkillPointMock()
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
    protected function createPsychicalSkillPointMock()
    {
        $psychicalSkillPoint = $this->mockery(PsychicalSkillPoint::class);
        $psychicalSkillPoint->shouldReceive('getGroupName')
            ->atLeast()->once()
            ->andReturn('bar psychical');

        return $psychicalSkillPoint;
    }

}
