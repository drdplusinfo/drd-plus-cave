<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

class Agility extends Property
{
    const AGILITY = 'agility';
    const PROPERTY_CODE = self::AGILITY;

    /**
     * @return string
     */
    public function getPropertyCode()
    {
        return self::PROPERTY_CODE;
    }

}
