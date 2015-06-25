<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;

class Beauty extends AbstractAspectOfVisage
{

    /**
     * @var int
     */
    private $value;

    public function __construct(Agility $agility, Knack $knack, Charisma $charisma)
    {
        $this->value = $this->calculateValue($agility, $knack, $charisma);
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
