<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\GameCharacteristics\Combat;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;

class Shooting
{
    /** @var Knack */
    private $knack;

    public function __construct(Knack $knack)
    {
        $this->knack = $knack;
    }

    /** @return int */
    public function getValue()
    {
        return (int)floor($this->knack->getValue() / 2);
    }
}
