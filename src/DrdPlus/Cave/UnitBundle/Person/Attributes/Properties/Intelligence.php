<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Parts\BaseProperty;

/**
 * @method static Intelligence getIt(int $value)
 * @see Property::getIt
 */
class Intelligence extends BaseProperty
{
    const INTELLIGENCE = 'intelligence';

    /**
     * @return string
     */
    public function getCode()
    {
        return self::INTELLIGENCE;
    }


}
