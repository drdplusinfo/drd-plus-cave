<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Choices\ExceptionalityChoice;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Choices\Fortune;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Choices\PlayerDecision;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Kinds\Combination;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Kinds\ExceptionalityKind;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Kinds\ExceptionalProperties;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Kinds\GoodRear;
use Granam\Strict\Object\StrictObject;

class ExceptionalityFactory extends StrictObject
{

    /**
     * Registers base exceptionalities
     */
    public function __construct()
    {
        ExceptionalityKind::registerSelf();
        Combination::registerSelfKind();
        ExceptionalProperties::registerSelfKind();
        GoodRear::registerSelfKind();

        ExceptionalityChoice::registerSelf();
        Fortune::registerSelfChoice();
        PlayerDecision::registerSelfChoice();
    }

    // KINDS

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
     * @return ExceptionalityChoice
     */
    public function getPlayerDecision()
    {
        return PlayerDecision::getIt();
    }

    /**
     * @return ExceptionalityChoice
     */
    public function getFortune()
    {
        return Fortune::getIt();
    }
}
