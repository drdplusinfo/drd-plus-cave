<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Genders;

/**
 * Male
 * @package DrdPlus\Cave\UnitBundle\Enum\Genders
 */
class Female extends Gender
{
    const CODE = 'female';
    const LABEL = 'Žena';

    /**
     * @return string
     */
    public function getCode()
    {
        return self::CODE;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return self::LABEL;
    }

}
