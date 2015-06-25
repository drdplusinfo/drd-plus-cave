<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;

class Dangerousness extends AbstractAspectOfVisage
{
    const DANGEROUSNESS = 'dangerousness';

    private $value;

    public function __construct(Strength $strength, Will $will, Charisma $charisma)
    {
        $this->value = $this->calculateValue($strength, $will, $charisma);
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
