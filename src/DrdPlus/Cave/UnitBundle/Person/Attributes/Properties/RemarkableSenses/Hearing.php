<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\RemarkableSenses;

use Doctrineum\Strict\String\StrictStringEnum;

class Hearing extends StrictStringEnum implements SenseInterface
{

    const HEARING = 'hearing';

    /**
     * @return self
     */
    public static function getIt()
    {
        return static::createByValue(self::HEARING);
    }
}
