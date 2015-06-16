<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

interface MeasurementInterface
{

    /**
     * @return float
     */
    public function getValue();

    /**
     * @return string
     */
    public function getUnit();
}
