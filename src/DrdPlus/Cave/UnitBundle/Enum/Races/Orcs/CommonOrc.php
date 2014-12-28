<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Orcs;

class CommonOrc extends Orc
{
    const CODE = 'common-orc';

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return self::CODE;
    }
}
