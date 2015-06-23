<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body;

use Granam\Integer\Integer;

class Size extends Integer
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
