<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\RemarkableSenses;

use Doctrineum\Strict\String\StrictStringEnum;

class Taste extends StrictStringEnum implements SenseInterface
{

    const TASTE = 'taste';

    /**
     * @return self
     */
    public static function getIt()
    {
        return static::createByValue(self::TASTE);
    }
}
