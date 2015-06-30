<?php
namespace DrdPlus\Cave\UnitBundle\Person\Background\Parts;

use DrdPlus\Cave\UnitBundle\Person\Background\Heritage;

abstract class AbstractHeritageDependentBackground extends AbstractBackground
{
    const MAX_POINTS_OVER_HERITAGE = 3;

    /**
     * @param int $backgroundPoints
     * @param Heritage $heritage
     *
     * @return static
     */
    public static function getIt($backgroundPoints, Heritage $heritage)
    {
        self::checkBackgroundPointsLimits($backgroundPoints);
        self::checkBackgroundPointsAgainstHeritage($backgroundPoints, $heritage);

        return self::getEnum($backgroundPoints);
    }

    protected static function checkBackgroundPointsAgainstHeritage($points, Heritage $heritage)
    {
        if ($points > ($heritage->getBackgroundPoints() + self::MAX_POINTS_OVER_HERITAGE)) {
            throw new \LogicException(
                self::getName() . ' can not get more points then '
                . ($heritage->getBackgroundPoints() + self::MAX_BACKGROUND_POINTS)
            );
        }
    }
}
