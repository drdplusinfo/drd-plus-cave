<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Krolls;

class CommonKroll extends Kroll
{
    const CODE = 'common-kroll';

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return self::CODE;
    }
}
