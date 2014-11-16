<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Genders;

/**
 * Male
 * @package DrdPlus\Cave\UnitBundle\Enum\Genders
 */
class Male extends Gender
{
    const CODE = 'male';
    const LABEL = 'Muž';

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
