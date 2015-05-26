<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Fates;

use DrdPlus\Cave\ToolsBundle\Dices\Roll;

class Combination extends AbstractFate
{
    /**
     * @return int
     */
    public function getPrimaryPropertiesBonusOnConservative()
    {
        return 2;
    }

    /**
     * @return int
     */
    public function getSecondaryPropertiesBonusOnConservative()
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
                $bonus = 0;
                break;
            case 3:
            case 4:
                $bonus = 1;
                break;
            case 5:
            case 6:
                $bonus = 2;
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
        // combination has same secondary and primary properties bonus
        return $this->getPrimaryPropertiesBonusOnFortune($roll);
    }

}
