<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

class Tables
{
    /**
     * @var WeightTable
     */
    private $weightTable;

    public function __construct()
    {
        $this->weightTable = new WeightTable();
    }

    /**
     * @return WeightTable
     */
    public function getWeightTable()
    {
        return $this->weightTable;
    }
}
