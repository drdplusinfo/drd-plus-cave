<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties;

use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body\WeightInKg;
use Granam\Strict\Object\StrictObject;

class NextLevelsProperties extends StrictObject
{
    /**
     * @var ProfessionLevels
     */
    private $professionLevels;

    /** @var Strength */
    private $strength;

    /** @var Agility */
    private $agility;

    /** @var Knack */
    private $knack;

    /** @var Will */
    private $will;

    /** @var Intelligence */
    private $intelligence;

    /** @var Charisma */
    private $charisma;

    /** @var WeightInKg */
    private $weightInKg;

    public function __construct(ProfessionLevels $professionLevels)
    {
        $this->professionLevels = $professionLevels;
        // TODO what about property value check? Or new, non-first level has no property increase limit?
        $this->strength = Strength::getIt($professionLevels->getNextLevelsStrengthModifier());
        $this->agility = Agility::getIt($professionLevels->getNextLevelsAgilityModifier());
        $this->knack = Knack::getIt($professionLevels->getNextLevelsKnackModifier());
        $this->will = Will::getIt($professionLevels->getNextLevelsWillModifier());
        $this->intelligence = Intelligence::getIt($professionLevels->getNextLevelsIntelligenceModifier());
        $this->charisma = Charisma::getIt($professionLevels->getNextLevelsCharismaModifier());
        $this->weightInKg = WeightInKg::getIt($professionLevels->getNextLevelsWeightModifier());
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
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @return Agility
     */
    public function getAgility()
    {
        return $this->agility;
    }

    /**
     * @return Knack
     */
    public function getKnack()
    {
        return $this->knack;
    }

    /**
     * @return Will
     */
    public function getWill()
    {
        return $this->will;
    }

    /**
     * @return Intelligence
     */
    public function getIntelligence()
    {
        return $this->intelligence;
    }

    /**
     * @return Charisma
     */
    public function getCharisma()
    {
        return $this->charisma;
    }

    /**
     * @return WeightInKg
     */
    public function getWeightInKg()
    {
        return $this->weightInKg;
    }
}
