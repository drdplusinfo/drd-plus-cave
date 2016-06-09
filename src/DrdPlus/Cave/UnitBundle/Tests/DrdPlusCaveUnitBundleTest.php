<?php
namespace DrdPlus\Cave\UnitBundle;

use Granam\Tests\Tools\TestWithMockery;

class DrdPlusCaveUnitBundleTest extends TestWithMockery
{
    /**
     * @return DrdPlusCaveUnitBundle
     *
     * @test
     */
    public function I_can_create_it()
    {
        $instance = new DrdPlusCaveUnitBundle();
        self::assertNotNull($instance);

        return $instance;
    }

}
