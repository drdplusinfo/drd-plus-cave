<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

use DrdPlus\Cave\TablesBundle\Tests\TestWithMockery;

class WeightTableTest extends TestWithMockery
{

    /**
     * @test
     */
    public function can_convert_bonus_to_kg()
    {
        $weightTable = new WeightTable();
        $this->assertSame(0.1, $weightTable->toKg(-40));
        $this->assertSame(10.0, $weightTable->toKg(0));
        $this->assertSame(9000.0, $weightTable->toKg(59));
    }

    /**
     * @test
     * @expectedException \OutOfRangeException
     */
    public function too_low_bonus_to_kg_cause_exception()
    {
        $weightTable = new WeightTable();
        $weightTable->toKg(-41);
    }

    /**
     * @test
     * @expectedException \OutOfRangeException
     */
    public function too_high_bonus_to_kg_cause_exception()
    {
        $weightTable = new WeightTable();
        $weightTable->toKg(60);
    }

    /**
     * @test
     */
    public function can_convert_kg_to_bonus()
    {
        $weightTable = new WeightTable();
        $this->assertSame(-40, $weightTable->toBonus(new WeightMeasurement(0.1)));
        $this->assertSame(-40, $weightTable->kgToBonus(0.1));

        $this->assertSame(10, $weightTable->toBonus(new WeightMeasurement(10)));
        $this->assertSame(10, $weightTable->kgToBonus(10));

        $this->assertSame(59, $weightTable->toBonus(new WeightMeasurement(9000)));
        $this->assertSame(59, $weightTable->kgToBonus(9000));
    }

    /**
     * @test
     */
    public function too_low_value_to_bonus_cause_exception()
    {
        $weightTable = new WeightTable();
        $weightTable->kgToBonus(0.09);
    }

    /**
     * @test
     */
    public function too_high_value_to_bonus_cause_exception()
    {
        $weightTable = new WeightTable();
        $weightTable->kgToBonus(9001);
    }
}
