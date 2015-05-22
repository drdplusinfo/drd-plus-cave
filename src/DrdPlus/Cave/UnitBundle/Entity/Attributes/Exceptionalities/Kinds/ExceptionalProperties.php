<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Kinds;

class ExceptionalProperties extends AbstractKind
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
    public function upToSingleProperty()
    {
        return 3;
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
                return 1;
            case 4:
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
        switch ($diceRoll) {
            case 1:
                return 0;
            case 2:
            case 3:
                return 1;
            case 4:
            case 5:
                return 2;
            case 6:
                return 3;
            default:
                throw new \RuntimeException(
                    'Unexpected dice roll value ' . var_export($diceRoll, true)
                );
        }
    }

}
