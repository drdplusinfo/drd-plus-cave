<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

use DrdPlus\Cave\TablesBundle\Tables\Amount\AmountTable;
use DrdPlus\Cave\TablesBundle\Tables\Distance\DistanceTable;
use DrdPlus\Cave\TablesBundle\Tables\Fatigue\FatigueTable;
use DrdPlus\Cave\TablesBundle\Tables\Speed\SpeedTable;
use DrdPlus\Cave\TablesBundle\Tables\Time\TimeTable;
use DrdPlus\Cave\TablesBundle\Tables\Weight\WeightTable;
use DrdPlus\Cave\TablesBundle\Tables\Wounds\WoundsTable;
use Granam\Strict\Object\StrictObject;

class Tables extends StrictObject
{

    /**
     * @var AmountTable
     */
    private $amountTable;

    /**
     * @var DistanceTable
     */
    private $distanceTable;

    /**
     * @var FatigueTable
     */
    private $fatigueTable;

    /**
     * @var SpeedTable
     */
    private $speedTable;

    /**
     * @var TimeTable
     */
    private $timeTable;

    /**
     * @var WeightTable
     */
    private $weightTable;

    /**
     * @var WoundsTable
     */
    private $woundsTable;

    public function __construct()
    {
        $this->amountTable = new AmountTable();
        $this->distanceTable = new DistanceTable();
        $this->fatigueTable = new FatigueTable();
        $this->speedTable = new SpeedTable();
        $this->timeTable = new TimeTable();
        $this->weightTable = new WeightTable();
        $this->woundsTable = new WoundsTable();
    }

    /**
     * @return AmountTable
     */
    public function getAmountTable()
    {
        return $this->amountTable;
    }

    /**
     * @return DistanceTable
     */
    public function getDistanceTable()
    {
        return $this->distanceTable;
    }

    /**
     * @return FatigueTable
     */
    public function getFatigueTable()
    {
        return $this->fatigueTable;
    }

    /**
     * @return SpeedTable
     */
    public function getSpeedTable()
    {
        return $this->speedTable;
    }

    /**
     * @return TimeTable
     */
    public function getTimeTable()
    {
        return $this->timeTable;
    }

    /**
     * @return WeightTable
     */
    public function getWeightTable()
    {
        return $this->weightTable;
    }

    /**
     * @return WoundsTable
     */
    public function getWoundsTable()
    {
        return $this->woundsTable;
    }

}
