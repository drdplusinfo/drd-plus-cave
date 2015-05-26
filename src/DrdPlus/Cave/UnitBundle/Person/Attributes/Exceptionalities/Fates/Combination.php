<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Fates;

use DrdPlus\Cave\ToolsBundle\Dices\Roll;

class Combination extends AbstractFate
{
    /**
     * @return int
     */
    public function getPrimaryPropertiesBonusOnChoice()
    {
        return 2;
    }

    /**
     * @return int
     */
    public function getSecondaryPropertiesBonusOnChoice()
    {
        return 4;
    }

    /**
     * @return int
     */
    public function getUpToSingleProperty()
    {
        return 2;
    }

    /**
     * @param Roll $roll
     *
     * @return int
     */
    public function getPrimaryPropertiesBonusOnFortune(Roll $roll)
    {
        switch ($roll->getRollSummary()) {
            case 1:
            case 2:
                return 0;
            case 3:
            case 4:
                return 1;
            case 5:
            case 6:
                return 2;
            default:
                throw new \RuntimeException(
                    'Unexpected roll value ' . var_export($roll->getRollSummary(), true)
                );
        }
    }

    /**
     * @param Roll $roll
     *
     * @return int
     */
    public function getSecondaryPropertiesBonusOnFortune(Roll $roll)
    {
        // combination has same secondary and primary properties bonus
        return $this->getPrimaryPropertiesBonusOnFortune($roll);
    }

}
