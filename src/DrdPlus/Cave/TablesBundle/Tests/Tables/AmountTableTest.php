<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

use DrdPlus\Cave\TablesBundle\Tests\TestWithMockery;

class AmountTableTest extends TestWithMockery
{

    /**
     * @test
     */
    public function can_convert_bonus_to_amount()
    {
        $amountTable = new AmountTable();
        do {
            $attempt = 1;
            $attempt++;
            $zeroOrOne = $amountTable->toAmount(-20);
            if ($zeroOrOne === 1.0) {
                break;
            }
        } while ($attempt < 1000);
        $this->assertSame(1.0, $zeroOrOne);
        $this->assertSame(1.0, $amountTable->toAmount(0));
        $this->assertSame(90000.0, $amountTable->toAmount(99));
    }

    /**
     * @test
     * @expectedException \OutOfRangeException
     */
    public function too_low_bonus_to_amount_cause_exception()
    {
        $amountTable = new AmountTable();
        $amountTable->toAmount(-21);
    }

    /**
     * @test
     * @expectedException \OutOfRangeException
     */
    public function too_high_bonus_to_amount_cause_exception()
    {
        $amountTable = new AmountTable();
        $amountTable->toAmount(100);
    }

    /**
     * @test
     */
    public function can_convert_amount_to_bonus()
    {
        $amountTable = new AmountTable();
        $this->assertSame(0, $amountTable->toBonus(new AmountMeasurement(1)));

        $this->assertSame(40, $amountTable->amountToBonus(104)); // 40 is the closest bonus
        $this->assertSame(41, $amountTable->amountToBonus(105)); // 40 and 41 are closest bonuses, 41 is taken because higher

        $this->assertSame(99, $amountTable->toBonus(new AmountMeasurement(90000)));
        $this->assertSame(99, $amountTable->amountToBonus(90000));
    }

    /**
     * @test
     * @expectedException \OutOfRangeException
     */
    public function too_low_value_to_bonus_cause_exception()
    {
        $amountTable = new AmountTable();
        $amountTable->toAmount(-1);
    }

    /**
     * @test
     * @expectedException \OutOfRangeException
     */
    public function too_high_value_to_bonus_cause_exception()
    {
        $amountTable = new AmountTable();
        $amountTable->amountToBonus(90001);
    }
}
