<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\ProfessionLevels\Parts;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\FighterLevel;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\PriestLevel;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ProfessionLevelsTest;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\RangerLevel;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\TheurgistLevel;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ThiefLevel;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\WizardLevel;

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
        /** @var ProfessionLevelsTest|ProfessionLevelsTestMultiProfessionNotAllowed $this */
        /** @var FighterLevel|\Mockery\MockInterface $firstLevel */
        $firstLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf(FighterLevel::class, $firstLevel);

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

    /**
     * @param ProfessionLevel $excludedProfession
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
        /** @var ProfessionLevelsTest|ProfessionLevelsTestMultiProfessionNotAllowed $this */
        /** @var PriestLevel|\Mockery\MockInterface $firstLevel */
        $firstLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf(PriestLevel::class, $firstLevel);

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

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends ranger_level_can_be_added
     * @expectedException \LogicException
     */
    public function other_professions_to_ranger_levels_cause_exception(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest|ProfessionLevelsTestMultiProfessionNotAllowed $this */
        /** @var RangerLevel|\Mockery\MockInterface $firstLevel */
        $firstLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf(RangerLevel::class, $firstLevel);

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

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends theurgist_level_can_be_added
     * @expectedException \LogicException
     */
    public function other_professions_to_theurgist_levels_cause_exception(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest|ProfessionLevelsTestMultiProfessionNotAllowed $this */
        /** @var TheurgistLevel|\Mockery\MockInterface $firstLevel */
        $firstLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf(TheurgistLevel::class, $firstLevel);

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

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends thief_level_can_be_added
     * @expectedException \LogicException
     */
    public function other_professions_to_thief_levels_cause_exception(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest|ProfessionLevelsTestMultiProfessionNotAllowed $this */
        /** @var ThiefLevel|\Mockery\MockInterface $firstLevel */
        $firstLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf(ThiefLevel::class, $firstLevel);

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

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends wizard_level_can_be_added
     * @expectedException \LogicException
     */
    public function other_professions_to_wizard_levels_cause_exception(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest|ProfessionLevelsTestMultiProfessionNotAllowed $this */
        /** @var WizardLevel|\Mockery\MockInterface $firstLevel */
        $firstLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf(WizardLevel::class, $firstLevel);

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

}
