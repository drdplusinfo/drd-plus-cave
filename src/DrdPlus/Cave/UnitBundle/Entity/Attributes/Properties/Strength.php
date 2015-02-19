<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

class Strength extends Property
{
    const PROPERTY_CODE = 'strength';

    /**
     * @return string
     */
    public function getPropertyCode()
    {
        return self::PROPERTY_CODE;
    }

}
