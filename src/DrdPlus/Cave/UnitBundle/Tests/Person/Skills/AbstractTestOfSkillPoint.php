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
     * @param bool $paidByBackgroundPoints
     *
     * @return \Mockery\MockInterface|PhysicalSkillPoint
     */
    protected function createPhysicalSkillPointMock($paidByBackgroundPoints = true)
    {
        return $this->createSkillPointMock(PhysicalSkillPoint::class, 'foo combined', $paidByBackgroundPoints);
    }

    private function createSkillPointMock(
        $skillPointClass,
        $typeName,
        $paidByBackgroundPoints
    )
    {
        $skillPoint = $this->mockery($skillPointClass);
        $skillPoint->shouldReceive('isPaidByFirstLevelBackgroundSkills')
            ->atLeast()->once()
            ->andReturn($paidByBackgroundPoints);
        $skillPoint->shouldReceive('getTypeName')
            ->atLeast()->once()
            ->andReturn($typeName);

        return $skillPoint;
    }

    /**
     * @param bool $paidByBackgroundPoints
     *
     * @return \Mockery\MockInterface|CombinedSkillPoint
     */
    protected function createCombinedSkillPointMock($paidByBackgroundPoints = true)
    {
        return $this->createSkillPointMock(CombinedSkillPoint::class, 'foo combined', $paidByBackgroundPoints);
    }


    /**
     * @param bool $paidByBackgroundPoints
     *
     * @return \Mockery\MockInterface|PsychicalSkillPoint
     */
    protected function createPsychicalSkillPointMock($paidByBackgroundPoints = true)
    {
        return $this->createSkillPointMock(PsychicalSkillPoint::class, 'foo combined', $paidByBackgroundPoints);
    }

    /**
     * @param $firstPropertyClass
     * @param bool $secondPropertyClass
     * @return \Mockery\MockInterface|ProfessionLevel
     */
    protected function createProfessionNextLevelLevelMock($firstPropertyClass, $secondPropertyClass = false)
    {
        $professionLevel = $this->mockery(ProfessionLevel::class);
        $professionLevel->shouldReceive('isFirstLevel')
            ->atLeast()->once()
            ->andReturn(false);
        $professionLevel->shouldReceive('isNextLevel')
            ->atLeast()->once()
            ->andReturn(true);
        $professionLevel->shouldReceive('get' . $this->parsePropertyName($firstPropertyClass) . 'Increment')
            ->atLeast()->once()
            ->andReturn($willIncrement = $this->mockery($firstPropertyClass));
        $willIncrement->shouldReceive('getValue')
            ->atLeast()->once()
            ->andReturn($secondPropertyClass ? 0 : 1);
        if ($secondPropertyClass) {
            $professionLevel->shouldReceive('get' . $this->parsePropertyName($secondPropertyClass) . 'Increment')
                ->atLeast()->once()
                ->andReturn($intelligenceIncrement = $this->mockery($secondPropertyClass));
            $intelligenceIncrement->shouldReceive('getValue')
                ->atLeast()->once()
                ->andReturn(1);
        }

        return $professionLevel;
    }

    private function parsePropertyName($propertyClass)
    {
        return basename(str_replace('\\', '/', $propertyClass));
    }

}
