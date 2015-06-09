<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties;

/**
 * @method static Agility getIt(int $value)
 * @see Property::getIt
 */
class Agility extends BaseProperty
{
    const AGILITY = 'agility';

    /**
     * @return string
     */
    public function getCode()
    {
        return self::AGILITY;
    }


}
