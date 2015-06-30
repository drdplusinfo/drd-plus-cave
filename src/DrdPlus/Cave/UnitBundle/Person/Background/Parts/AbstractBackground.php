<?php
namespace DrdPlus\Cave\UnitBundle\Person\Background\Parts;

use Doctrineum\Integer\SelfTypedIntegerEnum;

class AbstractBackground extends SelfTypedIntegerEnum
{

    const MIN_BACKGROUND_POINTS = 0;
    const MAX_BACKGROUND_POINTS = 8;

    protected static function checkBackgroundPointsLimits($points)
    {
        if ($points < self::MIN_BACKGROUND_POINTS || $points > self::MAX_BACKGROUND_POINTS) {
            throw new \LogicException(
                'Background points has to be between ' . self::MIN_BACKGROUND_POINTS . ' and '
                . self::MIN_BACKGROUND_POINTS . ", got $points"
            );
        }
    }
}
