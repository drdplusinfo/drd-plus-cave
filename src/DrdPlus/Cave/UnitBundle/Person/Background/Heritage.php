<?php
namespace DrdPlus\Cave\UnitBundle\Person\Background;

use Doctrineum\Integer\SelfTypedIntegerEnum;

/**
 * @method static Heritage getEnum($value)
 */
class Heritage extends SelfTypedIntegerEnum
{
    const FOUNDLING = 'foundling';
    const ORPHAN = 'orphan';
    const FROM_INCOMPLETE_FAMILY = 'from_incomplete_family';
    const FROM_DOUBTFULLY_FAMILY = 'from_doubtfully_family';
    const FROM_MODEST_FAMILY = 'from_modest_family';
    const FROM_WEALTHY_FAMILY = 'from_wealthy_family';
    const FROM_WEALTHY_AND_INFLUENTIAL_FAMILY = 'from_wealthy_and_influential_family';
    const NOBLE = 'noble';
    const NOBLE_FROM_POWERFUL_FAMILY = 'noble_from_powerful_family';

    /** @var  BackgroundPoints */
    private $backgroundPoints;

    /**
     * @param BackgroundPoints $backgroundPoints
     *
     * @return Heritage
     */
    public static function getIt(BackgroundPoints $backgroundPoints)
    {
        $heritage = self::getEnum($backgroundPoints->getValue());
        $heritage->backgroundPoints = $backgroundPoints;

        return $heritage;
    }

    /**
     * @return BackgroundPoints
     */
    public function getBackgroundPoints()
    {
        if (!isset($this->backgroundPoints)) {
            $this->backgroundPoints = new BackgroundPoints($this->getEnumValue());
        }

        return $this->getEnumValue();
    }

    /**
     * @return string
     */
    public function getName()
    {
        switch ($this->getBackgroundPoints()->getValue()) {
            case 0 :
                return self::FOUNDLING;
            case 1 :
                return self::ORPHAN;
            case 2:
                return self::FROM_INCOMPLETE_FAMILY;
            case 3:
                return self::FROM_DOUBTFULLY_FAMILY;
            case 4:
                return self::FROM_MODEST_FAMILY;
            case 5:
                return self::FROM_WEALTHY_FAMILY;
            case 6:
                return self::FROM_WEALTHY_AND_INFLUENTIAL_FAMILY;
            case 7:
                return self::NOBLE;
            case 8:
                return self::NOBLE_FROM_POWERFUL_FAMILY;
            default :
                throw new \LogicException("Unexpected heritage points: {$this->getBackgroundPoints()->getValue()}");
        }
    }
}
