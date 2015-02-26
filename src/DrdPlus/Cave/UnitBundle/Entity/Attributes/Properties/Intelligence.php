<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

class Intelligence extends Property
{
    const INTELLIGENCE = 'intelligence';
    const PROPERTY_CODE = self::INTELLIGENCE;

    /**
     * @return string
     */
    public function getPropertyCode()
    {
        return self::PROPERTY_CODE;
    }

}
