<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Choices\Fortune;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Choices\PlayerDecision;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Fates\FateOfCombination;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Fates\FateOfExceptionalProperties;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Fates\FateOfGoodRear;
use Granam\Strict\Object\StrictObject;

class ExceptionalityFactory extends StrictObject
{

    /**
     * Registers base exceptionalities
     */
    public function __construct()
    {
        FateOfCombination::registerSpecificFate();
        FateOfGoodRear::registerSpecificFate();
        FateOfExceptionalProperties::registerSpecificFate();

        Fortune::registerSelfChoice();
        PlayerDecision::registerSelfChoice();
    }

    // FATES

    /**
     * @return FateOfCombination
     */
    public function getCombination()
    {
        return FateOfCombination::getIt();
    }
    /**
     * @return FateOfGoodRear
     */
    public function getGoodRear()
    {
        return FateOfGoodRear::getIt();
    }

    /**
     * @return FateOfExceptionalProperties
     */
    public function getExceptionalProperties()
    {
        return FateOfExceptionalProperties::getIt();
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
