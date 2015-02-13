<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

class Will extends Property
{

    const PROPERTY_CODE = 'will';

    /**
     * @return string
     */
    public function getPropertyCode()
    {
        return self::PROPERTY_CODE;
    }

}
