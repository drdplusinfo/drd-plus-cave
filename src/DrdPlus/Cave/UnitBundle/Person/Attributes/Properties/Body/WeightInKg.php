<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body;

use Doctrineum\Float\SelfTypedFloatEnum;

class WeightInKg extends SelfTypedFloatEnum
{
    const WEIGHT_IN_KG = 'weight_in_kg';

    /**
     * @param int $value
     * @return self
     */
    public static function getIt($value)
    {
        return static::getEnum($value);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::WEIGHT_IN_KG;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->getEnumValue();
    }
}
