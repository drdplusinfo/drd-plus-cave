<?php
namespace DrdPlus\Cave\TablesBundle\Tests;

use DrdPlus\Cave\TablesBundle\Tables\WeightTable;

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
}
