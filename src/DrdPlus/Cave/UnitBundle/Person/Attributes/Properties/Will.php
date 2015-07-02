<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Parts\BaseProperty;

/**
 * @method static Will getIt(int $value)
 * @see Property::getIt
 */
class Will extends BaseProperty
{
    const WILL = 'will';

    /**
     * @return string
     */
    public function getCode()
    {
        return self::WILL;
    }


}
