<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Fates;

use DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\Exceptionalities\Fates\AbstractTestOfFate;

class CombinationTest extends AbstractTestOfFate
{

    protected function getExpectedPrimaryPropertiesBonusOnConservative()
    {
        return 2;
    }

    protected function getExpectedSecondaryPropertiesBonusOnConservative()
    {
        return 4;
    }

    protected function getExpectedUpToSingleProperty()
    {
        return 2;
    }

    /**
     * @param int $value
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
