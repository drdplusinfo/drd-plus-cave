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
        $this->checkFortunePropertyValue($strength, $fate, $profession);

        return $strength;
    }

    /**
     * @param Property $property
     * @param AbstractFate $fate
     * @param ProfessionLevel $profession
     */
    private function checkFortunePropertyValue(Property $property, AbstractFate $fate, ProfessionLevel $profession)
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
        $this->checkFortunePropertyValue($agility, $fate, $profession);

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
        $this->checkFortunePropertyValue($knack, $fate, $profession);

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
        $this->checkFortunePropertyValue($will, $fate, $profession);

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
        $this->checkFortunePropertyValue($charisma, $fate, $profession);

        return $charisma;
    }

    public function createChosenProperties(
        AbstractFate $fate,
        ProfessionLevel $profession,
        Strength $chosenStrength,
        Agility $chosenAgility,
        Knack $chosenKnack,
        Will $chosenWill,
        Intelligence $chosenIntelligence,
        Charisma $chosenCharisma
    )
    {
        $this->checkChosenProperty($profession, $fate, $chosenStrength);
        $this->checkChosenProperty($profession, $fate, $chosenAgility);
        $this->checkChosenProperty($profession, $fate, $chosenKnack);
        $this->checkChosenProperty($profession, $fate, $chosenWill);
        $this->checkChosenProperty($profession, $fate, $chosenIntelligence);
        $this->checkChosenProperty($profession, $fate, $chosenCharisma);

        $this->checkChosenProperties($chosenStrength, $chosenAgility, $chosenKnack, $chosenWill, $chosenIntelligence, $chosenCharisma, $profession, $fate);

        return new ChosenProperties($chosenStrength, $chosenAgility, $chosenKnack, $chosenWill, $chosenIntelligence, $chosenCharisma);
    }

    private function checkChosenProperty(ProfessionLevel $profession, AbstractFate $fate, Property $chosenProperty)
    {
        if ($profession->isPrimaryProperty($chosenProperty->getName())) {
            $maximalValue = $fate->getPrimaryPropertiesBonusOnConservative();
        } else {
            $maximalValue = $fate->getSecondaryPropertiesBonusOnConservative();
        }

        $this->checkChosenPropertyValue($maximalValue, $chosenProperty, $fate, $profession);
    }

    private function checkChosenPropertyValue($maximalValue, Property $chosenProperty, AbstractFate $fate, ProfessionLevel $professionLevel)
    {
        if ($chosenProperty->getValue() > $maximalValue) {
            throw new \LogicException(
                "Required {$chosenProperty->getName()} of value {$chosenProperty->getValue()} is higher then allowed"
                . " maximum $maximalValue for profession {$professionLevel->getProfessionCode()} and fate {$fate->getName()}"
            );
        }
    }

    private function checkChosenProperties(
        Strength $strength,
        Agility $agility,
        Knack $knack,
        Will $will,
        Intelligence $intelligence,
        Charisma $charisma,
        ProfessionLevel $profession,
        AbstractFate $fate
    )
    {
        $primaryPropertySum = 0;
        $secondaryPropertySum = 0;
        foreach ([$strength, $agility, $knack, $will, $intelligence, $charisma] as $property) {
            /** @var Property $property */
            if ($profession->isPrimaryProperty($property->getName())) {
                $primaryPropertySum += $property->getValue();
            } else {
                $secondaryPropertySum += $property->getValue();
            }
        }

        if ($primaryPropertySum !== $fate->getPrimaryPropertiesBonusOnConservative()) {
            throw new \LogicException(
                "Expected sum of primary properties is {$fate->getPrimaryPropertiesBonusOnConservative()}, got $primaryPropertySum"
            );
        }

        if ($secondaryPropertySum !== $fate->getSecondaryPropertiesBonusOnConservative()) {
            throw new \LogicException(
                "Expected sum of secondary properties is {$fate->getSecondaryPropertiesBonusOnConservative()}, got $secondaryPropertySum"
            );
        }
    }

}
