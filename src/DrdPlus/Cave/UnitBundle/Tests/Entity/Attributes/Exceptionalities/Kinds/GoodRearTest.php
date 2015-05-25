<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Kinds;

use DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\Exceptionalities\Kinds\AbstractTestOfKind;

class GoodRearTest extends AbstractTestOfKind
{

    protected function getExpectedPrimaryPropertiesBonusOnConservative()
    {
        return 1;
    }

    protected function getExpectedSecondaryPropertiesBonusOnConservative()
    {
        return 2;
    }

    protected function getExpectedUpToSingleProperty()
    {
        return 1;
    }

    /**
     * @param int $value
     *
     * @return int
     */
    protected function getExpectedPrimaryPropertiesBonusOnFortune($value)
    {
        return (int)floor($value / 4);
    }

    /**
     * @param int $value
     * @return int
     */
    protected function getExpectedSecondaryPropertiesBonusOnFortune($value)
    {
        return (int)floor($value / 4);
    }
}
