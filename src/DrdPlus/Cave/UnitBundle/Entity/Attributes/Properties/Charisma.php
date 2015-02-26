<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

class Charisma extends Property
{

    const CHARISMA = 'charisma';
    const PROPERTY_CODE = self::CHARISMA;

    /**
     * @return string
     */
    public function getPropertyCode()
    {
        return self::PROPERTY_CODE;
    }

}
