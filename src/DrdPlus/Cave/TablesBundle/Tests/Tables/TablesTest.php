<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

use DrdPlus\Cave\TablesBundle\Tables\Amount\AmountTable;
use DrdPlus\Cave\TablesBundle\Tables\Distance\DistanceTable;
use DrdPlus\Cave\TablesBundle\Tables\Fatigue\FatigueTable;
use DrdPlus\Cave\TablesBundle\Tables\Speed\SpeedTable;
use DrdPlus\Cave\TablesBundle\Tables\Time\TimeTable;
use DrdPlus\Cave\TablesBundle\Tables\Weight\WeightTable;
use DrdPlus\Cave\TablesBundle\Tables\Wounds\WoundsTable;
use DrdPlus\Cave\TablesBundle\Tests\TestWithMockery;

class TablesTest extends TestWithMockery
{

    /**
     * @test
     */
    public function can_give_any_on_table()
    {
        $tables = new Tables();
        $this->assertInstanceOf(WeightTable::class, $tables->getWeightTable());
        $this->assertInstanceOf(AmountTable::class, $tables->getAmountTable());
        $this->assertInstanceOf(DistanceTable::class, $tables->getDistanceTable());
        $this->assertInstanceOf(FatigueTable::class, $tables->getFatigueTable());
        $this->assertInstanceOf(SpeedTable::class, $tables->getSpeedTable());
        $this->assertInstanceOf(TimeTable::class, $tables->getTimeTable());
        $this->assertInstanceOf(WoundsTable::class, $tables->getWoundsTable());
    }

}
