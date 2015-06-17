<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

interface TableInterface
{

    /**
     * @param MeasurementInterface $measurement
     *
     * @return int
     */
    public function toBonus(MeasurementInterface $measurement);

    /**
     * @param int $bonus
     *
     * @return MeasurementInterface
     */
    public function toMeasurement($bonus);
}
