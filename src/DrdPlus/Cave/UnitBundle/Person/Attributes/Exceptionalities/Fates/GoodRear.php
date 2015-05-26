<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Fates;

use DrdPlus\Cave\ToolsBundle\Dices\Roll;

class GoodRear extends AbstractFate
{
    /**
     * @return int
     */
    public function getPrimaryPropertiesBonusOnChoice()
    {
        return 1;
    }

    /**
     * @return int
     */
    public function getSecondaryPropertiesBonusOnChoice()
    {
        return 2;
    }

    /**
     * @return int
     */
    public function getUpToSingleProperty()
    {
        return 1;
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
            case 3:
                return 0;
            case 4:
            case 5:
            case 6:
                return 1;
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
        // secondary and primary properties got same bonus
        return $this->getPrimaryPropertiesBonusOnFortune($roll);
    }

}
