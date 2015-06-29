<?php
namespace DrdPlus\Cave\UnitBundle\Person\Background;

use Granam\Integer\IntegerObject;

class BackgroundPoints extends IntegerObject
{
    const MIN_BACKGROUND_POINTS = 0;
    const MAX_BACKGROUND_POINTS = 8;

    public function __construct($value)
    {
        parent::__construct($value);
        $this->checkPoints($this->getValue());
    }

    private function checkPoints($value)
    {
        if ($value < self::MIN_BACKGROUND_POINTS || $value > self::MAX_BACKGROUND_POINTS) {
            throw new \LogicException(
                'Background points has to be between ' . self::MIN_BACKGROUND_POINTS . ' and ' . self::MIN_BACKGROUND_POINTS. ", got $value"
            );
        }
    }
}
