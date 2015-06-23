<?php
namespace DrdPlus\Cave\ToolsBundle\Tests\Dices;

use Drd\DiceRoll\Dice;
use DrdPlus\Cave\ToolsBundle\Dices\DiceRoll;
use DrdPlus\Cave\ToolsBundle\Tests\TestWithMockery;
use Granam\Integer\IntegerObject;

class DiceRollTest extends TestWithMockery
{
    /**
     * @test
     */
    public function can_be_created()
    {
        $instance = new DiceRoll($this->createDrdDiceRoll());

        $this->assertNotNull($instance);
    }

    /**
     * @return \Mockery\MockInterface|\Drd\DiceRoll\DiceRoll
     */
    private function createDrdDiceRoll()
    {
        $drdDiceRoll = $this->mockery(\Drd\DiceRoll\DiceRoll::class);
        $drdDiceRoll->shouldReceive('getDice')
            ->atLeast()->once()
            ->andReturn($evaluatedValue = $this->mockery(Dice::class));
        $evaluatedValue->shouldReceive('getMinimum')
            ->atLeast()->once()
            ->andReturn($minimum = $this->mockery(IntegerObject::class));
        $minimum->shouldReceive('getValue')
            ->atLeast()->once()
            ->andReturn(1);
        $evaluatedValue->shouldReceive('getMaximum')
            ->atLeast()->once()
            ->andReturn($maximum = $this->mockery(IntegerObject::class));
        $maximum->shouldReceive('getValue')
            ->atLeast()->once()
            ->andReturn(2);
        $drdDiceRoll->shouldReceive('getEvaluatedValue')
            ->atLeast()->once()
            ->andReturn($evaluatedValue = $this->mockery(IntegerObject::class));
        $evaluatedValue->shouldReceive('getValue')
            ->atLeast()->once()
            ->andReturn(1);
        $drdDiceRoll->shouldReceive('getRolledNumber')
            ->atLeast()->once()
            ->andReturn($rolledNumber = $this->mockery(IntegerObject::class));
        $rolledNumber->shouldReceive('getValue')
            ->atLeast()->once()
            ->andReturn(1);
        $drdDiceRoll->shouldReceive('getRollSequence')
            ->atLeast()->once()
            ->andReturn($rollSequence = $this->mockery(IntegerObject::class));
        $rollSequence->shouldReceive('getValue')
            ->atLeast()->once()
            ->andReturn(1);

        return $drdDiceRoll;
    }

    /**
     * @test
     * @depends can_be_created
     */
    public function can_return_same_values_as_created_with()
    {
        $drdDiceRoll = $this->createDrdDiceRoll();
        $diceRoll = new DiceRoll($drdDiceRoll);
        $this->assertSame($drdDiceRoll->getDice()->getMaximum()->getValue(), $diceRoll->getDice()->getMaximum());
        $this->assertSame($drdDiceRoll->getDice()->getMinimum()->getValue(), $diceRoll->getDice()->getMinimum());
        $this->assertSame($drdDiceRoll->getEvaluatedValue()->getValue(), $diceRoll->getEvaluatedValue());
        $this->assertSame($drdDiceRoll->getRolledNumber()->getValue(), $diceRoll->getRolledNumber());
        $this->assertSame($drdDiceRoll->getRollSequence()->getValue(), $diceRoll->getRollSequence());
    }
}
