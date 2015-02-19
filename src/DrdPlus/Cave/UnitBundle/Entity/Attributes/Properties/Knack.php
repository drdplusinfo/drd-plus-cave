<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

class Knack extends Property
{

    const PROPERTY_CODE = 'knack';

    /**
     * @return string
     */
    public function getPropertyCode()
    {
        return self::PROPERTY_CODE;
    }

}
