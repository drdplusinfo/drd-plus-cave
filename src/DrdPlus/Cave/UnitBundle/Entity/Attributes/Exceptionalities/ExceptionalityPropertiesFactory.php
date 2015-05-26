<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities;

use DrdPlus\Cave\ToolsBundle\Dices\Roll;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Choices\ExceptionalityChoice;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Choices\Fortune;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Fates\AbstractFate;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Property;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Will;
use Granam\Strict\Object\StrictObject;

class ExceptionalityPropertiesFactory extends StrictObject
{

    public function createFortuneProperties(
        ExceptionalityChoice $exceptionalityChoice,
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
        $this->checkFortuneChoice($exceptionalityChoice);
        $strength = $this->createFortuneStrength($profession, $fate, $strengthRoll);
        $agility = $this->createFortuneAgility($profession, $fate, $agilityRoll);
        $knack = $this->createFortuneKnack($profession, $fate, $knackRoll);
        $will = $this->createFortuneWill($profession, $fate, $willRoll);
        $intelligence = $this->createFortuneIntelligence($profession, $fate, $intelligenceRoll);
        $charisma = $this->createFortuneCharisma($profession, $fate, $charismaRoll);

        return new FortuneProperties($strength, $agility, $knack, $will, $intelligence, $charisma);
    }

    private function checkFortuneChoice(ExceptionalityChoice $exceptionalityChoice)
    {
        if ($exceptionalityChoice->getChoice() !== Fortune::FORTUNE) {
            throw new \LogicException();
        }
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
}
