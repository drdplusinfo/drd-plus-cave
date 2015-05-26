<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Humans;

use Doctrine\DBAL\Types\Type;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Race;
use DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\Races\AbstractTestOfRace;

class CommonHumanTest extends AbstractTestOfRace
{

    /**
     * @test
     */
    public function can_register_self()
    {
        $raceClass = $this->getSubraceClass();
        $raceClass::registerSelf();
        $this->assertTrue(Type::hasType($raceClass::getTypeName()));
    }

    /**
     * @return Race
     *
     * @test
     * @depends can_register_self
     */
    public function can_create_self()
    {
        return parent::can_create_self();
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_female_strength_modifier(Race $race)
    {
        $this->assertSame(-1, $race->getStrengthModifier($this->getSubraceFemale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_female_charisma_modifier(Race $race)
    {
        $this->assertSame(+1, $race->getCharismaModifier($this->getSubraceFemale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function requires_dungeon_master_agreement(Race $race)
    {
        $this->assertFalse($race->requiresDungeonMasterAgreement());
    }
}
