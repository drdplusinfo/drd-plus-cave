<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

class Will extends Property
{

    const WILL = 'will';
    const PROPERTY_CODE = self::WILL;

    /**
     * @return string
     */
    public function getPropertyCode()
    {
        return self::PROPERTY_CODE;
    }

}
