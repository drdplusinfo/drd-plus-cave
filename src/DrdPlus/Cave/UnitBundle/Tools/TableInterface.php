<?php
namespace DrdPlus\Cave\UnitBundle\Tools;

interface TableInterface
{

    /**
     * @param array $verticalIndexes
     * @param array $horizontalIndexes
     *
     * @return mixed
     */
    public function getValue(array $verticalIndexes, array $horizontalIndexes);
}
