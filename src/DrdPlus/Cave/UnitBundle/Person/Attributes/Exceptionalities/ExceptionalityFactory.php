<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Choices\Fortune;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Choices\PlayerDecision;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Fates\Combination;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Fates\ExceptionalProperties;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Fates\GoodRear;
use Granam\Strict\Object\StrictObject;

class ExceptionalityFactory extends StrictObject
{

    /**
     * Registers base exceptionalities
     */
    public function __construct()
    {
        Combination::registerSpecificFate();
        GoodRear::registerSpecificFate();
        ExceptionalProperties::registerSpecificFate();

        Fortune::registerSelfChoice();
        PlayerDecision::registerSelfChoice();
    }

    // FATES

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

    // CHOICES

    /**
     * @return PlayerDecision
     */
    public function getPlayerDecision()
    {
        return PlayerDecision::getIt();
    }

    /**
     * @return Fortune
     */
    public function getFortune()
    {
        return Fortune::getIt();
    }
}
