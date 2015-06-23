<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body;

use Granam\Integer\IntegerObject;

class Size extends IntegerObject
{
    const SIZE = 'size';

    /**
     * @return string
     */
    public function getName()
    {
        return self::SIZE;
    }
}
