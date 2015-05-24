<?php
namespace DrdPlus\Cave\ToolsBundle\Tests\Dices;

use DrdPlus\Cave\ToolsBundle\Dices\DiceRoll;
use DrdPlus\Cave\ToolsBundle\Dices\Roll;
use DrdPlus\Cave\ToolsBundle\Tests\TestWithMockery;

class RollTest extends TestWithMockery
{
    /**
     * @test
     */
    public function can_be_created()
    {
        $instance = new Roll([]);
        $this->assertNotNull($instance);
    }

    /**
     * @test
     */
    public function empty_dice_rolls_are_zero()
    {
        $roll = new Roll([]);
        $this->assertSame(0, $roll->getRollSummary());
    }

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function wrong_parameter_cause_exception()
    {
        new Roll(['string']);
    }

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function wrong_object_cause_exception()
    {
        new Roll([new \stdClass()]);
    }

    /**
     * @test
     */
    public function dice_rolls_are_summarized()
    {
        $roll = new Roll([$diceRoll1 = $this->mockery(DiceRoll::class), $diceRoll2 = $this->mockery(DiceRoll::class),]);
        $diceRoll1->shouldReceive('getEvaluatedValue')
            ->once()
            ->andReturn($diceRoll1Value = 123);
        $diceRoll2->shouldReceive('getEvaluatedValue')
            ->once()
            ->andReturn($diceRoll2Value = 456);
        $this->assertSame($diceRoll1Value + $diceRoll2Value, $roll->getRollSummary());
    }
}
