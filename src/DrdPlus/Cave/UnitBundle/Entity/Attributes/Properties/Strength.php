<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

class Strength extends Property
{
    const STRENGTH = 'strength';
    const PROPERTY_CODE = self::STRENGTH;

    /**
     * @return string
     */
    public function getPropertyCode()
    {
        return self::PROPERTY_CODE;
    }

}
