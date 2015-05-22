<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Kinds;

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
     * @param int $diceRoll
     *
     * @return int
     */
    abstract public function getPrimaryPropertiesBonusOnFortune($diceRoll);

    /**
     * @param int $diceRoll
     *
     * @return int
     */
    abstract public function getSecondaryPropertiesBonusOnFortune($diceRoll);

    /**
     * @return int
     */
    abstract public function upToSingleProperty();

}
