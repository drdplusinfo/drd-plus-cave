<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body;

use Granam\Strict\Integer\StrictInteger;

class Size extends StrictInteger implements BodyProperty
{
    const HEIGHT = 'height';

    /**
     * @return string
     */
    public function getName()
    {
        return self::HEIGHT;
    }
}
