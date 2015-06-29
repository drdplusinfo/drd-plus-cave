<?php
namespace DrdPlus\Cave\UnitBundle\Person\Background;

use DrdPlus\Cave\TablesBundle\Tables\Fatigue\PriceMeasurement;
use Granam\Strict\Object\StrictObject;

class BelongingsValue extends StrictObject
{
    /**
     * @var PriceMeasurement
     */
    private $measurement;

    public function __construct(BackgroundPoints $backgroundPoints)
    {
        $value = $this->calculateValue($backgroundPoints);
        $this->measurement = new PriceMeasurement($value, PriceMeasurement::GOLD_COIN);
    }

    private function calculateValue(BackgroundPoints $backgroundPoints)
    {
        switch ($backgroundPoints->getValue()) {
            case 0 :
                return 1;
            case 1 :
                return 3;
            case 2 :
                return 10;
            case 3 :
                return 30;
            case 4 :
                return 100;
            case 5 :
                return 300;
            case 6 :
                return 1000;
            case 7 :
                return 3000;
            case 8 :
                return 10000;
            default :
                throw new \LogicException("Unexpected background points {$backgroundPoints->getValue()}");
        }
    }

    /**
     * @return PriceMeasurement
     */
    public function getMeasurement()
    {
        return $this->measurement;
    }
}
