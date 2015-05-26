<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities;

use DrdPlus\Cave\ToolsBundle\Dices\Roll;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Fates\AbstractFate;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Property;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use Granam\Strict\Object\StrictObject;

class ExceptionalityPropertiesFactory extends StrictObject
{

    public function createFortuneProperties(
        AbstractFate $fate,
        ProfessionLevel $profession,
        Roll $strengthRoll,
        Roll $agilityRoll,
        Roll $knackRoll,
        Roll $willRoll,
        Roll $intelligenceRoll,
        Roll $charismaRoll
    )
    {
        $strength = $this->createFortuneStrength($profession, $fate, $strengthRoll);
        $agility = $this->createFortuneAgility($profession, $fate, $agilityRoll);
        $knack = $this->createFortuneKnack($profession, $fate, $knackRoll);
        $will = $this->createFortuneWill($profession, $fate, $willRoll);
        $intelligence = $this->createFortuneIntelligence($profession, $fate, $intelligenceRoll);
        $charisma = $this->createFortuneCharisma($profession, $fate, $charismaRoll);

        return new FortuneProperties($strength, $agility, $knack, $will, $intelligence, $charisma);
    }

    private function createFortuneStrength(ProfessionLevel $profession, AbstractFate $fate, Roll $strengthRoll)
    {
        if ($profession->isPrimaryProperty(Strength::STRENGTH)) {
            $strengthValue = $fate->getPrimaryPropertiesBonusOnFortune($strengthRoll);
        } else {
            $strengthValue = $fate->getSecondaryPropertiesBonusOnFortune($strengthRoll);
        }

        $strength = Strength::getIt($strengthValue);
        $this->checkPropertyValue($strength, $fate, $profession);

        return $strength;
    }

    /**
     * @param Property $property
     * @param AbstractFate $fate
     * @param ProfessionLevel $profession
     */
    private function checkPropertyValue(Property $property, AbstractFate $fate, ProfessionLevel $profession)
    {
        if ($property->getValue() > $fate->getUpToSingleProperty()) {
            throw new \LogicException(
                ucfirst($property->getName()) . " bonus on fortune should be at most {$fate->getUpToSingleProperty()} for profession {$profession->getProfessionCode()}, is $property"
            );
        }
    }

    private function createFortuneAgility(ProfessionLevel $profession, AbstractFate $fate, Roll $agilityRoll)
    {
        if ($profession->isPrimaryProperty(Agility::AGILITY)) {
            $agilityValue = $fate->getPrimaryPropertiesBonusOnFortune($agilityRoll);
        } else {
            $agilityValue = $fate->getSecondaryPropertiesBonusOnFortune($agilityRoll);
        }

        $agility = Agility::getIt($agilityValue);
        $this->checkPropertyValue($agility, $fate, $profession);

        return $agility;
    }

    private function createFortuneKnack(ProfessionLevel $profession, AbstractFate $fate, Roll $knackRoll)
    {
        if ($profession->isPrimaryProperty(Knack::KNACK)) {
            $knackValue = $fate->getPrimaryPropertiesBonusOnFortune($knackRoll);
        } else {
            $knackValue = $fate->getSecondaryPropertiesBonusOnFortune($knackRoll);
        }

        $knack = Knack::getIt($knackValue);
        $this->checkPropertyValue($knack, $fate, $profession);

        return $knack;
    }

    private function createFortuneWill(ProfessionLevel $profession, AbstractFate $fate, Roll $willRoll)
    {
        if ($profession->isPrimaryProperty(Will::WILL)) {
            $willValue = $fate->getPrimaryPropertiesBonusOnFortune($willRoll);
        } else {
            $willValue = $fate->getSecondaryPropertiesBonusOnFortune($willRoll);
        }

        $will = Will::getIt($willValue);
        $this->checkPropertyValue($will, $fate, $profession);

        return $will;
    }

    private function createFortuneIntelligence(ProfessionLevel $profession, AbstractFate $fate, Roll $intelligenceRoll)
    {
        if ($profession->isPrimaryProperty(Intelligence::INTELLIGENCE)) {
            $intelligenceValue = $fate->getPrimaryPropertiesBonusOnFortune($intelligenceRoll);
        } else {
            $intelligenceValue = $fate->getSecondaryPropertiesBonusOnFortune($intelligenceRoll);
        }

        return Intelligence::getIt($intelligenceValue);
    }

    private function createFortuneCharisma(ProfessionLevel $profession, AbstractFate $fate, Roll $charismaRoll)
    {
        if ($profession->isPrimaryProperty(Charisma::CHARISMA)) {
            $charismaValue = $fate->getPrimaryPropertiesBonusOnFortune($charismaRoll);
        } else {
            $charismaValue = $fate->getSecondaryPropertiesBonusOnFortune($charismaRoll);
        }

        $charisma = Charisma::getIt($charismaValue);
        $this->checkPropertyValue($charisma, $fate, $profession);

        return $charisma;
    }

    public function createChosenProperties(AbstractFate $fate, ProfessionLevel $profession)
    {
        $strength = $this->createChosenStrength($profession, $fate);
        $agility = $this->createChosenAgility($profession, $fate);
        $knack = $this->createChosenKnack($profession, $fate);
        $will = $this->createChosenWill($profession, $fate);
        $intelligence = $this->createChosenIntelligence($profession, $fate);
        $charisma = $this->createChosenCharisma($profession, $fate);

        return new ChosenProperties($strength, $agility, $knack, $will, $intelligence, $charisma);
    }

    private function createChosenStrength(ProfessionLevel $profession, AbstractFate $fate)
    {
        if ($profession->isPrimaryProperty(Strength::STRENGTH)) {
            $strengthValue = $fate->getPrimaryPropertiesBonusOnConservative();
        } else {
            $strengthValue = $fate->getSecondaryPropertiesBonusOnConservative();
        }

        $strength = Strength::getIt($strengthValue);
        $this->checkPropertyValue($strength, $fate, $profession);

        return $strength;
    }

    private function createChosenAgility(ProfessionLevel $profession, AbstractFate $fate)
    {
        if ($profession->isPrimaryProperty(Agility::AGILITY)) {
            $agilityValue = $fate->getPrimaryPropertiesBonusOnConservative();
        } else {
            $agilityValue = $fate->getSecondaryPropertiesBonusOnConservative();
        }

        $agility = Agility::getIt($agilityValue);
        $this->checkPropertyValue($agility, $fate, $profession);

        return $agility;
    }

    private function createChosenKnack(ProfessionLevel $profession, AbstractFate $fate)
    {
        if ($profession->isPrimaryProperty(Knack::KNACK)) {
            $knackValue = $fate->getPrimaryPropertiesBonusOnConservative();
        } else {
            $knackValue = $fate->getSecondaryPropertiesBonusOnConservative();
        }

        $knack = Knack::getIt($knackValue);
        $this->checkPropertyValue($knack, $fate, $profession);

        return $knack;
    }

    private function createChosenWill(ProfessionLevel $profession, AbstractFate $fate)
    {
        if ($profession->isPrimaryProperty(Will::WILL)) {
            $willValue = $fate->getPrimaryPropertiesBonusOnConservative();
        } else {
            $willValue = $fate->getSecondaryPropertiesBonusOnConservative();
        }

        $will = Will::getIt($willValue);
        $this->checkPropertyValue($will, $fate, $profession);

        return $will;
    }

    private function createChosenIntelligence(ProfessionLevel $profession, AbstractFate $fate)
    {
        if ($profession->isPrimaryProperty(Intelligence::INTELLIGENCE)) {
            $intelligenceValue = $fate->getPrimaryPropertiesBonusOnConservative();
        } else {
            $intelligenceValue = $fate->getSecondaryPropertiesBonusOnConservative();
        }

        $intelligence = Intelligence::getIt($intelligenceValue);
        $this->checkPropertyValue($intelligence, $fate, $profession);

        return $intelligence;
    }

    private function createChosenCharisma(ProfessionLevel $profession, AbstractFate $fate)
    {
        if ($profession->isPrimaryProperty(Charisma::CHARISMA)) {
            $charismaValue = $fate->getPrimaryPropertiesBonusOnConservative();
        } else {
            $charismaValue = $fate->getSecondaryPropertiesBonusOnConservative();
        }

        $charisma = Charisma::getIt($charismaValue);
        $this->checkPropertyValue($charisma, $fate, $profession);

        return $charisma;
    }

}
