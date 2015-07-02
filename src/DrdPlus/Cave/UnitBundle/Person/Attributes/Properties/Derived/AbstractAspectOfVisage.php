<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived;

use DrdPlus\Cave\ToolsBundle\Numbers\SumAndRound;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Parts\BaseProperty;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use Granam\Strict\Object\StrictObject;

abstract class AbstractAspectOfVisage extends StrictObject implements DerivedPropertyInterface
{

    /**
     * @param BaseProperty $firstProperty
     * @param BaseProperty $secondProperty
     * @param Charisma $charisma
     *
     * @return int
     */
    protected function calculateValue(BaseProperty $firstProperty, BaseProperty $secondProperty, Charisma $charisma)
    {
        return SumAndRound::average($firstProperty->getValue(), $secondProperty->getValue()) + SumAndRound::half($charisma->getValue() / 2);
    }
}
