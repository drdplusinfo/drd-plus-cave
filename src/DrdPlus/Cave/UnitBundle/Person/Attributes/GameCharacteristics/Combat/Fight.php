<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\GameCharacteristics\Combat;

use DrdPlus\Cave\ToolsBundle\Numbers\SumAndRound;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body\Size;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\PersonProperties;
use DrdPlus\Cave\UnitBundle\Person\Professions\Fighter;
use DrdPlus\Cave\UnitBundle\Person\Professions\Priest;
use DrdPlus\Cave\UnitBundle\Person\Professions\Profession;
use DrdPlus\Cave\UnitBundle\Person\Professions\Ranger;
use DrdPlus\Cave\UnitBundle\Person\Professions\Theurgist;
use DrdPlus\Cave\UnitBundle\Person\Professions\Thief;
use DrdPlus\Cave\UnitBundle\Person\Professions\Wizard;
use Granam\Strict\Object\StrictObject;

class Fight extends StrictObject
{

    /** @var Profession */
    private $profession;

    /** @var PersonProperties */
    private $personProperties;

    public function __construct(Profession $profession, PersonProperties $personProperties)
    {
        $this->profession = $profession;
        $this->personProperties = $personProperties;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        switch ($this->profession->getName()) {
            case Fighter::FIGHTER :
                return $this->getFighterFightValue($this->personProperties->getAgility(), $this->personProperties->getSize());
            case Thief::THIEF :
                return $this->getThiefFightValue($this->personProperties->getAgility(), $this->personProperties->getKnack(), $this->personProperties->getSize());
            case Ranger::RANGER :
                return $this->getRangerFightValue($this->personProperties->getAgility(), $this->personProperties->getKnack(), $this->personProperties->getSize());
            case Wizard::WIZARD :
                return $this->getWizardFightValue($this->personProperties->getAgility(), $this->personProperties->getIntelligence(), $this->personProperties->getSize());
            case Theurgist::THEURGIST :
                return $this->geTheurgistFightValue($this->personProperties->getAgility(), $this->personProperties->getIntelligence(), $this->personProperties->getSize());
            case Priest::PRIEST :
                return $this->getPriestFightValue($this->personProperties->getAgility(), $this->personProperties->getCharisma(), $this->personProperties->getSize());
            default :
                throw new \LogicException('Unknown profession of code ' . $this->profession->getName());
        }
    }

    private function getFighterFightValue(Agility $agility, Size $size)
    {
        return $agility->getValue() + $this->getModifierBySize($size);
    }

    private function getModifierBySize(Size $size)
    {
        if ($size->getValue() > 0) {
            // 1 - 3 = -1; 4 - 6 = 0; 7 - 9 = +1 ...
            return ceil($size->getValue() / 3) - 2;
        }

        // -2 - 0 = -2 ...
        return floor(($size->getValue() - 1) / 3) - 1;
    }

    private function getThiefFightValue(Agility $agility, Knack $knack, Size $size)
    {
        return SumAndRound::round($agility->getValue() + $knack->getValue()) + $this->getModifierBySize($size);
    }

    private function getRangerFightValue(Agility $agility, Knack $knack, Size $size)
    {
        // same as a thief
        return SumAndRound::round($agility->getValue() + $knack->getValue()) + $this->getModifierBySize($size);
    }

    private function getWizardFightValue(Agility $agility, Intelligence $intelligence, Size $size)
    {
        return SumAndRound::round($agility->getValue() + $intelligence->getValue()) + $this->getModifierBySize($size);
    }

    private function geTheurgistFightValue(Agility $agility, Intelligence $intelligence, Size $size)
    {
        // same as a wizard
        return SumAndRound::round($agility->getValue() + $intelligence->getValue()) + $this->getModifierBySize($size);
    }

    private function getPriestFightValue(Agility $agility, Charisma $charisma, Size $size)
    {
        return SumAndRound::round($agility->getValue() + $charisma->getValue()) + $this->getModifierBySize($size);
    }
}
