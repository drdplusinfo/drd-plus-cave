<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Kinds;

use DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\Exceptionalities\Kinds\AbstractTestOfKind;

class CombinationTest extends AbstractTestOfKind
{

    protected function getExpectedPrimaryPropertiesBonusOnConservative()
    {
        return 2;
    }

    protected function getExpectedSecondaryPropertiesBonusOnConservative()
    {
        return 4;
    }

    protected function getUpToSingleProperty()
    {
        return 2;
    }

    /**
     * @param int
     *
     * @return int
     */
    protected function getExpectedPrimaryPropertiesBonusOnFortune($value)
    {
        return (int)round($value / 2) - 1;
    }

    /**
     * @param int $value
     * @return int
     */
    protected function getExpectedSecondaryPropertiesBonusOnFortune($value)
    {
        return (int)round($value / 2) - 1;
    }


}
