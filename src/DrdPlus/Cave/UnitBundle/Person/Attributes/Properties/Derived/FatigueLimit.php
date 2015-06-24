<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived;

use DrdPlus\Cave\TablesBundle\Tables\Fatigue\FatigueTable;
use Granam\Strict\Object\StrictObject;

class FatigueLimit extends StrictObject implements DerivedPropertyInterface
{
    const FATIGUE_LIMIT = 'fatigue_limit';

    /**
     * @var int
     */
    private $value;

    public function __construct(Endurance $endurance, FatigueTable $fatigueTable)
    {
        $this->value = $fatigueTable->toFatigue($endurance->getValue() + 10);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getValue();
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }
}
