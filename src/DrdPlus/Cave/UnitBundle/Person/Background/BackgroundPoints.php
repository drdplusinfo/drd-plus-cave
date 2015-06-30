<?php
namespace DrdPlus\Cave\UnitBundle\Person\Background;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Fates\AbstractFate;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Fates\FateOfCombination;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Fates\FateOfExceptionalProperties;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Fates\FateOfGoodRear;
use Granam\Integer\IntegerInterface;

/**
 * @method static BackgroundPoints getEnum($backgroundPoints)
 * @method static BackgroundPoints getIt($backgroundPoints)
 */
class BackgroundPoints implements IntegerInterface
{
    /** @var int */
    private $pointsValue;

    public function __construct(AbstractFate $fate)
    {
        $this->pointsValue = $this->determinePoints($fate);
    }

    private function determinePoints(AbstractFate $fate)
    {
        switch ($fate->getFateName()) {
            case FateOfExceptionalProperties::FATE_OF_EXCEPTIONAL_PROPERTIES :
                return 5;
            case FateOfCombination::FATE_OF_COMBINATION :
                return 10;
            case FateOfGoodRear::FATE_OF_GOOD_REAR :
                return 15;
            default :
                throw new \LogicException("Unknown fate {$fate->getName()}");
        }
    }

    public function getValue()
    {
        return $this->pointsValue;
    }

    public function __toString()
    {
        return (string)$this->getValue();
    }

}
