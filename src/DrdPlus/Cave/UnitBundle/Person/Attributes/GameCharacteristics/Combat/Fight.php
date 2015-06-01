<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\GameCharacteristics\Combat;

use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\FighterLevel;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\PriestLevel;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\RangerLevel;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\TheurgistLevel;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ThiefLevel;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\WizardLevel;
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
        switch ($this->person->getProfessionLevels()->getFirstLevel()->getProfessionCode()) {
            case FighterLevel::FIGHTER :
                return $this->getFighterFightValue($this->person->getCurrentAgility(), $this->person->getSize());
            case ThiefLevel::THIEF :
                return $this->getThiefFightValue($this->person->getCurrentAgility(), $this->person->getCurrentKnack(), $this->person->getSize());
            case RangerLevel::RANGER :
                return $this->getRangerFightValue($this->person->getCurrentAgility(), $this->person->getCurrentKnack(), $this->person->getSize());
            case WizardLevel::WIZARD :
                return $this->getWizardFightValue($this->person->getCurrentAgility(), $this->person->getCurrentIntelligence(), $this->person->getSize());
            case TheurgistLevel::THEURGIST :
                return $this->geTheurgistFightValue($this->person->getCurrentAgility(), $this->person->getCurrentIntelligence(), $this->person->getSize());
            case PriestLevel::PRIEST :
                return $this->getPriestFightValue($this->person->getCurrentAgility(), $this->person->getCurrentCharisma(), $this->person->getSize());
            default :
                throw new \LogicException('Unknown profession of code ' . $this->person->getProfessionLevels()->getFirstLevel()->getProfessionCode());
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
        return intval(round($agility->getValue() + $knack->getValue()) + $this->getModifierBySize($size));
    }

    private function getRangerFightValue(Agility $agility, Knack $knack, Size $size)
    {
        // same as a thief
        return intval(round($agility->getValue() + $knack->getValue()) + $this->getModifierBySize($size));
    }

    private function getWizardFightValue(Agility $agility, Intelligence $intelligence, Size $size)
    {
        return intval(round($agility->getValue() + $intelligence->getValue()) + $this->getModifierBySize($size));
    }

    private function geTheurgistFightValue(Agility $agility, Intelligence $intelligence, Size $size)
    {
        // same as a wizard
        return intval(round($agility->getValue() + $intelligence->getValue()) + $this->getModifierBySize($size));
    }

    private function getPriestFightValue(Agility $agility, Charisma $charisma, Size $size)
    {
        return intval(round($agility->getValue() + $charisma->getValue()) + $this->getModifierBySize($size));
    }
}
