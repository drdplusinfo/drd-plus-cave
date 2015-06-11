<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\RemarkableSenses;

use Doctrineum\Strict\String\StrictStringEnum;

class Smell extends StrictStringEnum implements SenseInterface
{

    const SMELL = 'smell';

    /**
     * @return self
     */
    public static function getIt()
    {
        return static::createByValue(self::SMELL);
    }
}
