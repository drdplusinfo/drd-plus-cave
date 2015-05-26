<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\ProfessionLevels\Parts;

use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\FighterLevel;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\PriestLevel;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevelsTest;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\RangerLevel;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\TheurgistLevel;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ThiefLevel;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\WizardLevel;

trait ProfessionLevelsTestMultiProfessionNotAllowed
{

    /**
     * @var \Mockery\MockInterface[]|ProfessionLevel[]|array $levels
     */
    private $professionLevels = [];

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends fighter_level_can_be_added
     * @expectedException \LogicException
     */
    public function other_professions_to_fighter_levels_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->otherProfessionsCauseException('fighter', $professionLevels);
    }

    private function otherProfessionsCauseException(
        $professionName,
        ProfessionLevels $professionLevels
    )
    {
        /** @var ProfessionLevelsTest|ProfessionLevelsTestMultiProfessionNotAllowed $this */
        /** @var FighterLevel|\Mockery\MockInterface $firstLevel */
        $firstLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf($this->getMultiProfessionTestLevelClass($professionName), $firstLevel);

        $exception = new \Exception('No other professions than ' . $firstLevel->getProfessionCode() . '?');
        foreach ($this->getLevelsExcept($firstLevel) as $professionCode => $otherProfessionLevel) {
            $adder = 'add' . ucfirst($professionCode) . 'Level';
            try {
                $professionLevels->$adder($otherProfessionLevel);
                $this->fail("Adding $professionCode to levels already set to {$firstLevel->getProfessionCode()} should throw exception.");
            } catch (\LogicException $exception) {
                $this->assertNotNull($exception);
            }
        }

        throw $exception;
    }

    private function getMultiProfessionTestLevelClass($professionName)
    {
        return '\DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\\'
        . ucfirst($professionName) . 'Level';
    }

    /**
     * @param ProfessionLevel $excludedProfession
     *
     * @return \Mockery\MockInterface[]|ProfessionLevel[]
     */
    private function getLevelsExcept(ProfessionLevel $excludedProfession)
    {
        if (empty($this->professionLevels)) {
            $this->buildProfessionLevels();
        }

        return array_filter(
            $this->professionLevels,
            function (ProfessionLevel $level) use ($excludedProfession) {
                return $level->getProfessionCode() !== $excludedProfession->getProfessionCode();
            }
        );
    }

    private function buildProfessionLevels()
    {
        $this->professionLevels['fighter'] = \Mockery::mock(FighterLevel::class);
        $this->professionLevels['priest'] = \Mockery::mock(PriestLevel::class);
        $this->professionLevels['ranger'] = \Mockery::mock(RangerLevel::class);
        $this->professionLevels['theurgist'] = \Mockery::mock(TheurgistLevel::class);
        $this->professionLevels['thief'] = \Mockery::mock(ThiefLevel::class);
        $this->professionLevels['wizard'] = \Mockery::mock(WizardLevel::class);
        foreach ($this->professionLevels as $professionCode => $level) {
            $level->shouldReceive('getProfessionCode')
                ->andReturn($professionCode);
        }
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends priest_level_can_be_added
     * @expectedException \LogicException
     */
    public function other_professions_to_priest_levels_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->otherProfessionsCauseException('priest', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends ranger_level_can_be_added
     * @expectedException \LogicException
     */
    public function other_professions_to_ranger_levels_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->otherProfessionsCauseException('ranger', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends theurgist_level_can_be_added
     * @expectedException \LogicException
     */
    public function other_professions_to_theurgist_levels_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->otherProfessionsCauseException('theurgist', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends thief_level_can_be_added
     * @expectedException \LogicException
     */
    public function other_professions_to_thief_levels_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->otherProfessionsCauseException('thief', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends wizard_level_can_be_added
     * @expectedException \LogicException
     */
    public function other_professions_to_wizard_levels_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->otherProfessionsCauseException('wizard', $professionLevels);
    }

}
