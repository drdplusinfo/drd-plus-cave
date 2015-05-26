<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Fates;

use DrdPlus\Cave\ToolsBundle\Dices\Roll;

class ExceptionalProperties extends AbstractFate
{
    /**
     * @return int
     */
    public function getPrimaryPropertiesBonusOnConservative()
    {
        return 3;
    }

    /**
     * @return int
     */
    public function getSecondaryPropertiesBonusOnConservative()
    {
        return 6;
    }

    /**
     * @return int
     */
    public function getUpToSingleProperty()
    {
        return 3;
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
                $bonus = 1;
                break;
            case 4:
            case 5:
            case 6:
                $bonus = 2;
                break;
            default:
                throw new \RuntimeException(
                    'Unexpected dice roll value ' . var_export($roll->getRollSummary(), true)
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
        switch ($roll->getRollSummary()) {
            case 1:
                $bonus = 0;
                break;
            case 2:
            case 3:
                $bonus = 1;
                break;
            case 4:
            case 5:
                $bonus = 2;
                break;
            case 6:
                $bonus = 3;
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

}
