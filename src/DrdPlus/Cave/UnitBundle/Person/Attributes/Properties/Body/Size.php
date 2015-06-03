<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body;

use Granam\Strict\Integer\StrictInteger;

class Size extends StrictInteger
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
