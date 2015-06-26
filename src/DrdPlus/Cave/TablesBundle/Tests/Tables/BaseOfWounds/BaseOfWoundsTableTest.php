<?php
namespace DrdPlus\Cave\TablesBundle\Tables\BaseOfWounds;

use DrdPlus\Cave\TablesBundle\Tests\TestWithMockery;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;

class BaseOfWoundsTableTest extends TestWithMockery
{

    /**
     * @test
     */
    public function can_calculate_base_of_wounds()
    {
        $baseOfWoundsTable = new BaseOfWoundsTable();

        $this->assertSame(-4, $baseOfWoundsTable->calculateBaseOfWounds(Strength::getIt(-5), -5));
        $this->assertSame(1, $baseOfWoundsTable->calculateBaseOfWounds(Strength::getIt(0), 0));
        $this->assertSame(21, $baseOfWoundsTable->calculateBaseOfWounds(Strength::getIt(20), 20));
        $this->assertSame(15, $baseOfWoundsTable->calculateBaseOfWounds(Strength::getIt(-5), 20));
        $this->assertSame(15, $baseOfWoundsTable->calculateBaseOfWounds(Strength::getIt(20), -5));
        $this->assertSame(15, $baseOfWoundsTable->getBonusesIntersection([20, -5]));
        $this->assertSame(7, $baseOfWoundsTable->getBonusesIntersection([-5, -4, -3, 10]));
        for ($bonus = -5; $bonus <= 20; $bonus++) {
            $this->assertSame($bonus, $baseOfWoundsTable->getBonusesIntersection([$bonus]));
        }
    }

    /**
     * @test
     */
    public function can_sum_bonuses() // like weights
    {
        $baseOfWoundsTable = new BaseOfWoundsTable();

        $this->assertSame(5, $baseOfWoundsTable->sumBonuses([-5, -5, -5]));
        $this->assertSame(14, $baseOfWoundsTable->sumBonuses([-5, 0, 10]));
        $this->assertSame(13, $baseOfWoundsTable->sumBonuses([-5, -4, -3, -2, -1, 0]));
    }

    /**
     * @test
     */
    public function can_double_bonus()
    {
        $baseOfWoundsTable = new BaseOfWoundsTable();

        $this->assertSame(11, $baseOfWoundsTable->doubleBonus(5));
    }

    /**
     * @test
     */
    public function can_half_bonus()
    {
        $baseOfWoundsTable = new BaseOfWoundsTable();

        $this->assertSame(-1, $baseOfWoundsTable->halfBonus(5));
    }

    /**
     * @test
     */
    public function can_ten_times_multiple_bonus()
    {
        $baseOfWoundsTable = new BaseOfWoundsTable();

        $this->assertSame(25, $baseOfWoundsTable->tenMultipleBonus(5));
    }

    /**
     * @test
     */
    public function can_ten_times_divide_bonus()
    {
        $baseOfWoundsTable = new BaseOfWoundsTable();

        $this->assertSame(-15, $baseOfWoundsTable->tenMinifyBonus(5));
    }

}