<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\GameCharacteristics\Combat;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;

class Attack
{

    /** @var Agility */
    private $agility;

    public function __construct(Agility $agility)
    {
        $this->agility = $agility;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return (int)floor($this->agility->getValue() / 2);
    }
}
