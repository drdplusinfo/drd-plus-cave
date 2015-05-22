<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Kinds;

class GoodRear extends AbstractKind
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
     * @param int $diceRoll
     *
     * @return int
     */
    public function getPrimaryPropertiesBonusOnFortune($diceRoll)
    {
        switch ($diceRoll) {
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
                    'Unexpected dice roll value ' . var_export($diceRoll, true)
                );
        }
    }

    /**
     * @param int $diceRoll
     *
     * @return int
     */
    public function getSecondaryPropertiesBonusOnFortune($diceRoll)
    {
        // secondary and primary properties got same bonus
        return $this->getPrimaryPropertiesBonusOnFortune($diceRoll);
    }

    /**
     * @return int
     */
    public function upToSingleProperty()
    {
        return 1;
    }

}
