<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Fates;

use DrdPlus\Cave\ToolsBundle\Dices\Roll;

abstract class AbstractFate extends AbstractFateEntity
{

    /**
     * @return int
     */
    abstract public function getPrimaryPropertiesBonusOnChoice();

    /**
     * @return int
     */
    abstract public function getSecondaryPropertiesBonusOnChoice();

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
