<?php
namespace DrdPlus\Cave\UnitBundle\Person\Background;

class InitialPropertyInGoldCoins
{
    public static function getInitialPropertyInGoldCoins(BackgroundPoints $backgroundPoints)
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
}
