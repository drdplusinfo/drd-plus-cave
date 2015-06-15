<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

interface MeasurementInterface extends StrictFloatInterface
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
