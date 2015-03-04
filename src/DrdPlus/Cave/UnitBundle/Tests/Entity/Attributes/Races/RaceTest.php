<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races;

class RaceTest extends \PHPUnit_Framework_TestCase {

    /** @test */
    public function can_register_self_even_as_abstract_class()
    {
        Race::registerSelf();
        $this->assertTrue(Race::hasType(Race::getTypeName()));
    }

    /** @test */
    public function has_type_name_as_expected()
    {
        $this->assertSame('race', Race::getTypeName());
        $this->assertSame(Race::TYPE_RACE, Race::getTypeName());
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\AbstractRaceCanNotBeCreated
     */
    public function creating_abstract_race_enum_cause_exception()
    {
        Race::getEnum('foo');
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\MissingRaceCodeImplementation
     */
    public function creating_abstract_race_enum_by_shortcut_cause_exception()
    {
        Race::getIt();
    }

}
