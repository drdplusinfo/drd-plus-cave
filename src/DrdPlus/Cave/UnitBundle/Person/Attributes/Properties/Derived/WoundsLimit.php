<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived;

use DrdPlus\Cave\TablesBundle\Tables\Wounds\WoundsTable;
use Granam\Strict\Object\StrictObject;

class WoundsLimit extends StrictObject implements DerivedPropertyInterface
{
    const WOUNDS_LIMIT = 'wounds_limit';

    /**
     * @var int
     */
    private $value;

    public function __construct(Toughness $toughness, WoundsTable $woundsTable)
    {
        $this->value = $woundsTable->toWounds($toughness->getValue() + 10);
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
