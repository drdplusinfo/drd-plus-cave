<?php
namespace DrdPlus\Cave\TablesBundle\Tables\BaseOfWounds;

use DrdPlus\Cave\TablesBundle\Tests\TestWithMockery;

class BaseOfWoundsTableTest extends TestWithMockery
{

    /**
     * @test
     */
    public function can_sum_bonuses()
    {
        $baseOfWoundsTable = new BaseOfWoundsTable();

        $this->assertSame(-4, $baseOfWoundsTable->sumTwoBonuses(-5, -5));
        $this->assertSame(1, $baseOfWoundsTable->sumTwoBonuses(0, 0));
        $this->assertSame(21, $baseOfWoundsTable->sumTwoBonuses(20, 20));
        $this->assertSame(15, $baseOfWoundsTable->sumTwoBonuses(-5, 20));
        $this->assertSame(15, $baseOfWoundsTable->sumTwoBonuses(20, -5));
        $this->assertSame(15, $baseOfWoundsTable->sumBonuses([20, -5]));
        $this->assertSame(7, $baseOfWoundsTable->sumBonuses([-5, -4, -3, 10]));
        for ($bonus = -5; $bonus <= 20; $bonus++) {
            $this->assertSame($bonus, $baseOfWoundsTable->sumBonuses([$bonus]));
        }
    }

}
