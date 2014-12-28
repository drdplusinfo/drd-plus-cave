<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Humans;

class CommonHuman extends Human
{
    const CODE = 'common-human';

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return self::CODE;
    }
}
