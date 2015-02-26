<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

use Doctrineum\Integer\IntegerSelfTypedEnum;

abstract class Property extends IntegerSelfTypedEnum
{

    const PROPERTY_CODE = 'property';

    /**
     * Call this method on specific property, not on this abstract class (it is prohibited by exception raising anyway)
     *
     * @param string $propertyCode
     * @param string $innerNamespace
     * @return Property
     */
    public static function getEnum($propertyCode, $innerNamespace = __CLASS__)
    {
        parent::getEnum($propertyCode, $innerNamespace);
    }

    /**
     * @param string $propertyCode
     * @throws Exceptions\UnknownPropertyCode
     * @return Property
     */
    protected static function createByValue($propertyCode)
    {
        $property = parent::createByValue($propertyCode);
        /** @var $property Property */
        if ($property->getPropertyCode() !== $propertyCode) {
            throw new Exceptions\UnknownPropertyCode(
                'Given unexpected property code ' . var_export($propertyCode, true) . '. ' .
                'Expected ' . var_export($property->getPropertyCode(), true) . '. ' .
                'Has been this method ' . __METHOD__ . ' called from specific property class?'
            );
        }

        if ($property->getPropertyCode() !== static::PROPERTY_CODE) {
            throw new Exceptions\InconsistentPropertyCodes(
                'The dynamic property code ' . var_export($property->getPropertyCode(), true) .
                ' has to be same as static property code ' . var_export(static::PROPERTY_CODE, true) . '. ' .
                'Has been this method ' . __METHOD__ . ' called from specific property class?'
            );
        }

        return $property;
    }

    public static function getTypeName()
    {
        return static::PROPERTY_CODE;
    }

    /**
     * @return string
     */
    abstract public function getPropertyCode();

}
