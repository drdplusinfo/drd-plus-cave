<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Fates;

use DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\Exceptionalities\Fates\AbstractTestOfFate;

class ExceptionalPropertiesTest extends AbstractTestOfFate
{

    protected function getExpectedPrimaryPropertiesBonusOnConservative()
    {
        return 3;
    }

    protected function getExpectedSecondaryPropertiesBonusOnConservative()
    {
        return 6;
    }

    protected function getExpectedUpToSingleProperty()
    {
        return 3;
    }

    /**
     * @param int $value
     *
     * @return int
     */
    protected function getExpectedPrimaryPropertiesBonusOnFortune($value)
    {
        return (int)ceil($value / 3);
    }

    /**
     * @param int $value
     * @return int
     */
    protected function getExpectedSecondaryPropertiesBonusOnFortune($value)
    {
        return (int)floor($value / 2);
    }
}
