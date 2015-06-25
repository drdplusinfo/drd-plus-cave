<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\GameCharacteristics\Combat;

use DrdPlus\Cave\ToolsBundle\Numbers\SumAndRound;
use DrdPlus\Cave\UnitBundle\Person\Professions\Fighter;
use DrdPlus\Cave\UnitBundle\Person\Professions\Priest;
use DrdPlus\Cave\UnitBundle\Person\Professions\Ranger;
use DrdPlus\Cave\UnitBundle\Person\Professions\Theurgist;
use DrdPlus\Cave\UnitBundle\Person\Professions\Thief;
use DrdPlus\Cave\UnitBundle\Person\Professions\Wizard;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body\Size;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Person;
use Granam\Strict\Object\StrictObject;

class Fight extends StrictObject
{

    /**
     * @var Person
     */
    private $person;

    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        switch ($this->person->getProfessionLevels()->getFirstLevel()->getProfession()->getName()) {
            case Fighter::FIGHTER :
                return $this->getFighterFightValue($this->person->getPersonProperties()->getAgility(), $this->person->getPersonProperties()->getSize());
            case Thief::THIEF :
                return $this->getThiefFightValue($this->person->getPersonProperties()->getAgility(), $this->person->getPersonProperties()->getKnack(), $this->person->getPersonProperties()->getSize());
            case Ranger::RANGER :
                return $this->getRangerFightValue($this->person->getPersonProperties()->getAgility(), $this->person->getPersonProperties()->getKnack(), $this->person->getPersonProperties()->getSize());
            case Wizard::WIZARD :
                return $this->getWizardFightValue($this->person->getPersonProperties()->getAgility(), $this->person->getPersonProperties()->getIntelligence(), $this->person->getPersonProperties()->getSize());
            case Theurgist::THEURGIST :
                return $this->geTheurgistFightValue($this->person->getPersonProperties()->getAgility(), $this->person->getPersonProperties()->getIntelligence(), $this->person->getPersonProperties()->getSize());
            case Priest::PRIEST :
                return $this->getPriestFightValue($this->person->getPersonProperties()->getAgility(), $this->person->getPersonProperties()->getCharisma(), $this->person->getPersonProperties()->getSize());
            default :
                throw new \LogicException('Unknown profession of code ' . $this->person->getProfessionLevels()->getFirstLevel()->getProfession()->getName());
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
