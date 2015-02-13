<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

/**
 * class Gender
 */
abstract class Property extends IntegerEnum
{

    /**
     * Call this method on specific property, not on this abstract class (it is prohibited by exception raising anyway)
     *
     * @param string $propertyCode
     * @param string $innerNamespace
     * @return Property
     */
    public static function get($propertyCode, $innerNamespace = __CLASS__)
    {
        parent::get($propertyCode, $innerNamespace);
    }

    /**
     * @param string $propertyCode
     * @throws Exceptions\UnknownPropertyCode
     * @return Property
     */
    protected static function create($propertyCode)
    {
        $property = parent::create($propertyCode);
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
