<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

class Intelligence extends Property
{
    const PROPERTY_CODE = 'intelligence';

    /**
     * @return string
     */
    public function getPropertyCode()
    {
        return self::INTELLIGENCE_CODE;
    }

}
