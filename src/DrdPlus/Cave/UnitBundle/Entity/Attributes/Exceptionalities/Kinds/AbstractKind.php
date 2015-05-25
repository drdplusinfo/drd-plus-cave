<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Kinds;

use DrdPlus\Cave\ToolsBundle\Dices\Roll;

/**
 * @method static AbstractKind getIt()
 * @see ExceptionalityKind::getIt()
 */
abstract class AbstractKind extends ExceptionalityKind
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
