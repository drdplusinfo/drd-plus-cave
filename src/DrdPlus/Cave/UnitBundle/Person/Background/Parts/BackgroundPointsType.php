<?php
namespace DrdPlus\Cave\UnitBundle\Person\Background\Parts;

use Doctrine\DBAL\Types\Type;
use Doctrineum\Integer\IntegerEnumType;
use DrdPlus\Cave\UnitBundle\Person\Background\BackgroundPoints;

class BackgroundPointsType extends IntegerEnumType
{
    const BACKGROUND_POINTS = 'background_points';

    public static function registerSelf()
    {
        if (!Type::hasType(self::BACKGROUND_POINTS)) {
            Type::addType(self::BACKGROUND_POINTS, static::class);
        } else if (Type::getTypesMap()[self::BACKGROUND_POINTS] !== static::class) {
            throw new \LogicException();
        }
    }

    protected static function getDefaultEnumClass()
    {
        return BackgroundPoints::class;
    }
}
