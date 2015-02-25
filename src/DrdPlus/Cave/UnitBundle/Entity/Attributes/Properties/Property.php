<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

use Doctrineum\Integer\IntegerSelfTypedEnum;

abstract class Property extends IntegerSelfTypedEnum
{

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
                'Unknown property code ' . var_export($propertyCode, true) . '. Has been this method called from specific property class?'
            );
        }

        return $property;
    }

    /**
     * @return string
     */
    abstract public function getPropertyCode();

}
