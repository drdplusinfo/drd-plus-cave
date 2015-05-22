<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Kinds;

class Combination extends AbstractKind
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
    public function upToSingleProperty()
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
                return 0;
            case 3:
            case 4:
                return 1;
            case 5:
            case 6:
                return 2;
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
        // combination has same secondary and primary properties bonus
        return $this->getPrimaryPropertiesBonusOnFortune($diceRoll);
    }

}
