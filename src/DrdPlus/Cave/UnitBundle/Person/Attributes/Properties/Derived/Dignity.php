<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;

class Dignity extends AbstractAspectOfVisage
{
    const DIGNITY = 'dignity';

    /**
     * @var int
     */
    private $value;

    public function __construct(Intelligence $intelligence, Will $will, Charisma $charisma)
    {
        $this->value = $this->calculateValue($intelligence, $will, $charisma);
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getValue();
    }

}
