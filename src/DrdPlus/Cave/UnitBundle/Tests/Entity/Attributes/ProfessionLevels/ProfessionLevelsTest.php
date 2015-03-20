<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels;

use DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\ProfessionLevels\Parts\ProfessionLevelsTestMultiProfessionNotAllowed;
use DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\ProfessionLevels\Parts\ProfessionLevelsTestNewIsEmptyTrait;
use DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\ProfessionLevels\Parts\ProfessionLevelsTestFirstLevelsTrait;
use DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\ProfessionLevels\Parts\ProfessionLevelsTestMoreLevelsTrait;
use DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\ProfessionLevels\Parts\ProfessionLevelsTestPersonCanBeSet;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

class ProfessionLevelsTest extends TestWithMockery
{

    /**
     * @return ProfessionLevels
     *
     * @test
     */
    public function can_create_instance()
    {
        $instance = new ProfessionLevels();
        $this->assertNotNull($instance);

        return $instance;
    }

    /*
     * EMPTY AFTER INITIALIZATION
     */

    use ProfessionLevelsTestNewIsEmptyTrait;

    /*
     * PERSON
     */

    use ProfessionLevelsTestPersonCanBeSet;

    /*
     * FIRST LEVELS
     */

    use ProfessionLevelsTestFirstLevelsTrait;

    /*
     * MORE LEVELS
     */

    use ProfessionLevelsTestMoreLevelsTrait;

    /*
     * ONLY SINGLE PROFESSION IS ALLOWED
     */

    use ProfessionLevelsTestMultiProfessionNotAllowed;

}
