<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

use Granam\Strict\Object\StrictObject;

/**
 * PPH page 165, top
 */
class FatigueTable extends StrictObject implements TableInterface
{
    /**
     * @var WoundsTable
     */
    private $woundsTable;

    public function __construct()
    {
        // fatigue has the very same conversions as wounds have
        $this->woundsTable = new WoundsTable();
    }

    /**
     * @param MeasurementInterface $fatigueMeasurement
     *
     * @return int
     */
    public function toBonus(MeasurementInterface $fatigueMeasurement)
    {
        return $this->woundsTable->woundsToBonus($fatigueMeasurement->getValue());
    }

    /**
     * @param int $bonus
     *
     * @return FatigueMeasurement
     */
    public function toMeasurement($bonus)
    {
        $wounds = $this->woundsTable->toMeasurement($bonus);

        return new FatigueMeasurement($wounds->getValue(), FatigueMeasurement::FATIGUE);
    }

    /**
     * @param float $amount
     *
     * @return int
     */
    public function fatigueToBonus($amount)
    {
        return $this->woundsTable->woundsToBonus($amount);
    }

    /**
     * @param int $bonus
     *
     * @return float
     */
    public function toFatigue($bonus)
    {
        return $this->toMeasurement($bonus)->getValue();
    }

}
