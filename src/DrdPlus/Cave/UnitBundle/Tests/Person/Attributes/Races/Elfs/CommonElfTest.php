<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Elfs;

use Doctrine\DBAL\Types\Type;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Race;
use DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\Races\Elfs\AbstractTestOfElf;

class CommonElfTest extends AbstractTestOfElf
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
    public function gives_expected_male_strength_modifier(Race $race)
    {
        $this->assertSame(-1, $race->getStrengthModifier($this->getSubraceMale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_female_strength_modifier(Race $race)
    {
        $this->assertSame(-2, $race->getStrengthModifier($this->getSubraceFemale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_male_agility_modifier(Race $race)
    {
        $this->assertSame(+1, $race->getAgilityModifier($this->getSubraceMale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_female_agility_modifier(Race $race)
    {
        $this->assertSame(+1, $race->getAgilityModifier($this->getSubraceFemale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_male_knack_modifier(Race $race)
    {
        $this->assertSame(+1, $race->getKnackModifier($this->getSubraceMale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_female_knack_modifier(Race $race)
    {
        $this->assertSame(+2, $race->getKnackModifier($this->getSubraceFemale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_male_will_modifier(Race $race)
    {
        $this->assertSame(-2, $race->getWillModifier($this->getSubraceMale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_female_will_modifier(Race $race)
    {
        $this->assertSame(-2, $race->getWillModifier($this->getSubraceFemale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_male_intelligence_modifier(Race $race)
    {
        $this->assertSame(+1, $race->getIntelligenceModifier($this->getSubraceMale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_male_charisma_modifier(Race $race)
    {
        $this->assertSame(+1, $race->getCharismaModifier($this->getSubraceMale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_female_charisma_modifier(Race $race)
    {
        $this->assertSame(+2, $race->getCharismaModifier($this->getSubraceFemale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_male_resistance_modifier(Race $race)
    {
        $this->assertSame(-1, $race->getResistanceModifier($this->getSubraceMale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_female_resistance_modifier(Race $race)
    {
        $this->assertSame(-1, $race->getResistanceModifier($this->getSubraceFemale()));
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
