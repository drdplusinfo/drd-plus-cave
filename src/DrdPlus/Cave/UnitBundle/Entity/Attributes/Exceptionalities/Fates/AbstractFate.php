<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Fates;

use DrdPlus\Cave\ToolsBundle\Dices\Roll;

abstract class AbstractFate extends ExceptionalityFate
{

    /**
     * @return int
     */
    abstract public function getPrimaryPropertiesBonusOnConservative();

    /**
     * @return int
     */
    abstract public function getSecondaryPropertiesBonusOnConservative();

    /**
     * @param Roll $roll
     *
     * @return int
     */
    abstract public function getPrimaryPropertiesBonusOnFortune(Roll $roll);

    /**
     * @param Roll $roll
     *
     * @return int
     */
    abstract public function getSecondaryPropertiesBonusOnFortune(Roll $roll);

    /**
     * @return int
     */
    abstract public function getUpToSingleProperty();

}
