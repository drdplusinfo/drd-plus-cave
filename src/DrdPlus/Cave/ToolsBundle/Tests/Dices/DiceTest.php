<?php
namespace DrdPlus\Cave\ToolsBundle\Enum;

use Drd\DiceRoll\DiceInterface;
use DrdPlus\Cave\ToolsBundle\Dices\Dice;
use Granam\Strict\Integer\StrictInteger;

class DiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function can_be_created()
    {
        $drdDice = \Mockery::mock(DiceInterface::class);
        $drdDice->shouldReceive('getMinimum')
            ->once()
            ->andReturn($minimum = \Mockery::mock(StrictInteger::class));
        $minimum->shouldReceive('getValue')
            ->andReturn(1);
        $drdDice->shouldReceive('getMaximum')
            ->once()
            ->andReturn($maximum = \Mockery::mock(StrictInteger::class));
        $maximum->shouldReceive('getValue')
            ->andReturn(2);
        /** @var DiceInterface $drdDice */
        $instance = new Dice($drdDice);
        $this->assertNotNull($instance);
    }

    /**
     * @test
     * @depends can_be_created
     */
    public function can_return_given_minimum_value()
    {
        $drdDice = \Mockery::mock(DiceInterface::class);
        $drdDice->shouldReceive('getMinimum')
            ->once()
            ->andReturn($minimum = \Mockery::mock(StrictInteger::class));
        $minimum->shouldReceive('getValue')
            ->andReturn($minimumValue = 1);
        $drdDice->shouldReceive('getMaximum')
            ->once()
            ->andReturn($maximum = \Mockery::mock(StrictInteger::class));
        $maximum->shouldReceive('getValue')
            ->andReturn(2);
        /** @var DiceInterface $drdDice */
        $dice = new Dice($drdDice);
        $this->assertSame($minimumValue, $dice->getMinimum());
    }

    /**
     * @test
     * @depends can_be_created
     */
    public function can_return_given_maximum_value()
    {
        $drdDice = \Mockery::mock(DiceInterface::class);
        $drdDice->shouldReceive('getMinimum')
            ->once()
            ->andReturn($minimum = \Mockery::mock(StrictInteger::class));
        $minimum->shouldReceive('getValue')
            ->andReturn(1);
        $drdDice->shouldReceive('getMaximum')
            ->once()
            ->andReturn($maximum = \Mockery::mock(StrictInteger::class));
        $maximum->shouldReceive('getValue')
            ->andReturn($maximumValue = 2);
        /** @var DiceInterface $drdDice */
        $dice = new Dice($drdDice);
        $this->assertSame($maximumValue, $dice->getMaximum());
    }
}
