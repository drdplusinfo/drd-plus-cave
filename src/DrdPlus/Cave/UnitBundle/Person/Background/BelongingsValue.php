<?php
namespace DrdPlus\Cave\UnitBundle\Person\Background;

use DrdPlus\Cave\TablesBundle\Tables\Fatigue\PriceMeasurement;
use DrdPlus\Cave\UnitBundle\Person\Background\Parts\AbstractHeritageDependentBackground;

/**
 * @method static BelongingsValue getEnum(int $backgroundPoints)
 * @method static BelongingsValue getIt(int $backgroundPoints, Heritage $heritage)
 */
class BelongingsValue extends AbstractHeritageDependentBackground
{
    /**
     * @var PriceMeasurement
     */
    private $measurement;

    /**
     * @return PriceMeasurement
     */
    public function getMeasurement()
    {
        if (!isset($this->measurement)) {
            $belongingsValue = $this->calculateBelongingsValue($this->getEnumValue());
            $this->measurement = new PriceMeasurement($belongingsValue, PriceMeasurement::GOLD_COIN);
        }

        return $this->measurement;
    }


    private function calculateBelongingsValue($backgroundPoints)
    {
        switch ($backgroundPoints) {
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
                throw new \LogicException("Unexpected background points {$backgroundPoints}");
        }
    }

}
