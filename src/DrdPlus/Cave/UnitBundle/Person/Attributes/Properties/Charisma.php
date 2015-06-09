<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties;

/**
 * @method static Charisma getIt(int $value)
 * @see Property::getIt
 */
class Charisma extends BaseProperty
{
    const CHARISMA = 'charisma';

    /**
     * @return string
     */
    public function getCode()
    {
        return self::CHARISMA;
    }


}
