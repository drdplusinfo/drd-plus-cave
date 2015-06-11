<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\RemarkableSenses;

use Doctrineum\Strict\String\StrictStringEnum;

class Touch extends StrictStringEnum implements SenseInterface
{

    const TOUCH = 'touch';

    /**
     * @return self
     */
    public static function getIt()
    {
        return static::createByValue(self::TOUCH);
    }
}
