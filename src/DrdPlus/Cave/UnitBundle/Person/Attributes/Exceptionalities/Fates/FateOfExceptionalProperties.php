<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Fates;

use DrdPlus\Cave\ToolsBundle\Dices\Roll;

class FateOfExceptionalProperties extends AbstractFate
{
    const FATE_OF_EXCEPTIONAL_PROPERTIES = 'fate_of_exceptional_properties';
    /**
     * @return int
     */
    public function getPrimaryPropertiesBonusOnChoice()
    {
        return 3;
    }

    /**
     * @return int
     */
    public function getSecondaryPropertiesBonusOnChoice()
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
                return 1;
            case 4:
            case 5:
            case 6:
                return 2;
            default:
                throw new \RuntimeException(
                    'Unexpected dice roll value ' . var_export($roll->getRollSummary(), true)
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
        switch ($roll->getRollSummary()) {
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
                    'Unexpected roll value ' . var_export($roll->getRollSummary(), true)
                );
        }
    }

}
