<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Fates;

use DrdPlus\Cave\ToolsBundle\Dices\Roll;

class GoodRear extends AbstractFate
{
    /**
     * @return int
     */
    public function getPrimaryPropertiesBonusOnConservative()
    {
        return 1;
    }

    /**
     * @return int
     */
    public function getSecondaryPropertiesBonusOnConservative()
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
                $bonus = 0;
                break;
            case 4:
            case 5:
            case 6:
                $bonus = 1;
                break;
            default:
                throw new \RuntimeException(
                    'Unexpected roll value ' . var_export($roll->getRollSummary(), true)
                );
        }

        if ($bonus > $this->getUpToSingleProperty()) {
            throw new \LogicException(
                "Property bonus on fortune should be at most {$this->getUpToSingleProperty()}, is $bonus"
            );
        }

        return $bonus;
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
