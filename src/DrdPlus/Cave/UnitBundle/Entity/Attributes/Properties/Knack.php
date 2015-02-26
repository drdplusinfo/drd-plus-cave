<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

class Knack extends Property
{

    const KNACK = 'knack';
    const PROPERTY_CODE = self::KNACK;

    /**
     * @return string
     */
    public function getPropertyCode()
    {
        return self::PROPERTY_CODE;
    }

}
