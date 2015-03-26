<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities;

use Granam\Strict\Object\StrictObject;

class ExceptionalityFactory extends StrictObject
{

    public function __construct()
    {
        Combination::registerSelf();
        ExceptionalProperties::registerSelf();
        GoodRear::registerSelf();
    }

    /**
     * @return Combination
     */
    public function getCombination()
    {
        return Combination::getIt();
    }
    /**
     * @return GoodRear
     */
    public function getGoodRear()
    {
        return GoodRear::getIt();
    }

    /**
     * @return ExceptionalProperties
     */
    public function getExceptionalProperties()
    {
        return ExceptionalProperties::getIt();
    }
}
