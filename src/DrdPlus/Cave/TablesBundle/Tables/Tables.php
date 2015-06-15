<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

class Tables
{
    /**
     * @var WeightTable
     */
    private $weightTable;

    /**
     * @var DistanceTable
     */
    private $distanceTable;

    public function __construct()
    {
        $this->weightTable = new WeightTable();
        $this->distanceTable = new DistanceTable();
    }

    /**
     * @return WeightTable
     */
    public function getWeightTable()
    {
        return $this->weightTable;
    }

    /**
     * @return DistanceTable
     */
    public function getDistanceTable()
    {
        return $this->distanceTable;
    }
}
