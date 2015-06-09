<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties;

use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevels;
use Granam\Strict\Object\StrictObject;

class NextLevelsProperties extends StrictObject
{
    /**
     * @var ProfessionLevels
     */
    private $professionLevels;

    /** @var Strength */
    private $nextLevelsStrength;

    /** @var Agility */
    private $nextLevelsAgility;

    /** @var Knack */
    private $nextLevelsKnack;

    /** @var Will */
    private $nextLevelsWill;

    /** @var Intelligence */
    private $nextLevelsIntelligence;

    /** @var Charisma */
    private $nextLevelsCharisma;

    public function __construct(ProfessionLevels $professionLevels)
    {
        $this->professionLevels = $professionLevels;
        $this->setUpProperty($this->createNextLevelsStrength($professionLevels));
        $this->setUpProperty($this->createNextLevelsAgility($professionLevels));
        $this->setUpProperty($this->createNextLevelsKnack($professionLevels));
        $this->setUpProperty($this->createNextLevelsWill($professionLevels));
        $this->setUpProperty($this->createNextLevelsIntelligence($professionLevels));
        $this->setUpProperty($this->createNextLevelsCharisma($professionLevels));
    }

    private function createNextLevelsStrength(ProfessionLevels $professionLevels)
    {
        return Strength::getIt($professionLevels->getNextLevelsStrengthModifier());
    }

    /**
     * @param BaseProperty $baseProperty
     *
     * @throws Exceptions\PropertyIsAlreadySet
     * @throws Exceptions\BasePropertyValueExceeded
     */
    private function setUpProperty(BaseProperty $baseProperty)
    {
        /** @var string|BaseProperty $localPropertyName */
        $propertyName = ucfirst($baseProperty->getName());
        $localPropertyName = "nextLevels{$propertyName}";
        if (isset($this->$localPropertyName)) {
            throw new Exceptions\PropertyIsAlreadySet(
                'The property ' . $localPropertyName . ' is already set by value ' . var_export($this->$localPropertyName->getValue(), true)
            );
        }

        // TODO new, non-first level has no property increase limit?

        $this->$localPropertyName = $baseProperty;
    }

    private function createNextLevelsAgility(ProfessionLevels $professionLevels)
    {
        return Agility::getIt($professionLevels->getNextLevelsAgilityModifier());
    }

    private function createNextLevelsKnack(ProfessionLevels $professionLevels)
    {
        return Knack::getIt($professionLevels->getNextLevelsKnackModifier());
    }

    private function createNextLevelsWill(ProfessionLevels $professionLevels)
    {
        return Will::getIt($professionLevels->getNextLevelsWillModifier());
    }

    private function createNextLevelsIntelligence(ProfessionLevels $professionLevels)
    {
        return Intelligence::getIt($professionLevels->getNextLevelsIntelligenceModifier());
    }

    private function createNextLevelsCharisma(ProfessionLevels $professionLevels)
    {
        return Charisma::getIt($professionLevels->getNextLevelsCharismaModifier());
    }

    /**
     * @return ProfessionLevels
     */
    public function getProfessionLevels()
    {
        return $this->professionLevels;
    }

    /**
     * @return Strength
     */
    public function getNextLevelsStrength()
    {
        return $this->nextLevelsStrength;
    }

    /**
     * @return Agility
     */
    public function getNextLevelsAgility()
    {
        return $this->nextLevelsAgility;
    }

    /**
     * @return Knack
     */
    public function getNextLevelsKnack()
    {
        return $this->nextLevelsKnack;
    }

    /**
     * @return Will
     */
    public function getNextLevelsWill()
    {
        return $this->nextLevelsWill;
    }

    /**
     * @return Intelligence
     */
    public function getNextLevelsIntelligence()
    {
        return $this->nextLevelsIntelligence;
    }

    /**
     * @return Charisma
     */
    public function getNextLevelsCharisma()
    {
        return $this->nextLevelsCharisma;
    }

}
