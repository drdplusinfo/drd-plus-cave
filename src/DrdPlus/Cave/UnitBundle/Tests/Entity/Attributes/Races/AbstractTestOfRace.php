<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\Races;

use Doctrine\DBAL\Types\Type;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Race;

abstract class AbstractTestOfRace extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function subrace_code_is_as_expected()
    {
        $raceClass = $this->getSubraceClass();
        $this->assertSame($this->buildSubraceCode(), $raceClass::getSubraceCode());
    }

    /**
     * @return string|Race
     */
    protected function getSubraceClass()
    {
        return preg_replace('~Test$~', '', static::class);
    }

    /**
     * @return string
     */
    protected function buildSubraceCode()
    {
        $baseSubraceName = $this->getSubraceBaseName();
        $underScoredClassName = preg_replace('~(\w)([A-Z])~', '$1_$2', $baseSubraceName);

        return strtolower($underScoredClassName);
    }

    /**
     * @return string
     */
    protected function getSubraceBaseName()
    {
        $subraceClass = $this->getSubraceClass();

        return preg_replace('~(\w+\\\)*(\w+)~', '$2', $subraceClass);
    }

    /**
     * @test
     * @depends subrace_code_is_as_expected
     */
    public function type_name_is_as_expected()
    {
        $raceClass = $this->getSubraceClass();
        $this->assertSame(
            $raceClass::getRaceCode() . '-' . $raceClass::getSubraceCode(),
            $raceClass::getTypeName()
        );
    }

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
        $raceClass = $this->getSubraceClass();
        $instance = $raceClass::getIt();
        $this->assertInstanceOf($raceClass, $instance);

        return $instance;
    }

    // ATTRIBUTES TESTS

    /**
     * @param Race $race
     *
     * @test
     *
     * @depends can_create_self
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\UnexpectedRace
     */
    public function using_gender_of_different_race_cause_exception(Race $race)
    {
        SomeGenderOfUnexpectedRace::registerSelf();
        $race->getStrengthModifier(SomeGenderOfUnexpectedRace::getIt());
    }

    /**
     * @test
     *
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\UnexpectedSubrace
     */
    public function using_gender_of_different_subrace_cause_exception()
    {
        SomeSubraceOfUnexpectedGenderSubrace::registerSelf();
        $subrace = SomeSubraceOfUnexpectedGenderSubrace::getIt();
        SomeGenderOfUnexpectedRace::registerSelf();
        $subrace->getStrengthModifier(SomeGenderOfUnexpectedRace::getIt());
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_male_strength_modifier(Race $race)
    {
        $this->assertSame(0, $race->getStrengthModifier($this->getSubraceMale()));
    }

    /**
     * @return Gender
     */
    protected function getSubraceMale()
    {
        $subraceMaleClass = $this->getSubraceMaleClass();
        $subraceMaleClass::registerSelf();

        return $subraceMaleClass::getIt();
    }

    /**
     * @return string|Gender
     */
    protected function getSubraceMaleClass()
    {
        return $this->getGenderNamespace() . '\\' . $this->getSubraceBaseName() . 'Male';
    }

    /**
     * @return string
     */
    protected function getGenderNamespace()
    {
        $subraceClass = $this->getSubraceClass();
        $subraceNamespace = preg_replace('~\\\[\w]+$~', '', $subraceClass);

        return $subraceNamespace . '\\Genders';
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_female_strength_modifier(Race $race)
    {
        $this->assertSame(0, $race->getStrengthModifier($this->getSubraceFemale()));
    }

    /**
     * @return Gender
     */
    protected function getSubraceFemale()
    {
        $subraceFemaleClass = $this->getSubraceFemaleClass();
        $subraceFemaleClass::registerSelf();

        return $subraceFemaleClass::getIt();
    }

    /**
     * @return string|Gender
     */
    protected function getSubraceFemaleClass()
    {
        return $this->getGenderNamespace() . '\\' . $this->getSubraceBaseName() . 'Female';
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_male_agility_modifier(Race $race)
    {
        $this->assertSame(0, $race->getAgilityModifier($this->getSubraceMale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_female_agility_modifier(Race $race)
    {
        $this->assertSame(0, $race->getAgilityModifier($this->getSubraceFemale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_male_knack_modifier(Race $race)
    {
        $this->assertSame(0, $race->getKnackModifier($this->getSubraceMale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_female_knack_modifier(Race $race)
    {
        $this->assertSame(0, $race->getKnackModifier($this->getSubraceFemale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_male_will_modifier(Race $race)
    {
        $this->assertSame(0, $race->getWillModifier($this->getSubraceMale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_female_will_modifier(Race $race)
    {
        $this->assertSame(0, $race->getWillModifier($this->getSubraceFemale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_male_intelligence_modifier(Race $race)
    {
        $this->assertSame(0, $race->getIntelligenceModifier($this->getSubraceMale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_female_intelligence_modifier(Race $race)
    {
        $this->assertSame(0, $race->getIntelligenceModifier($this->getSubraceFemale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_male_charisma_modifier(Race $race)
    {
        $this->assertSame(0, $race->getCharismaModifier($this->getSubraceMale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_female_charisma_modifier(Race $race)
    {
        $this->assertSame(0, $race->getCharismaModifier($this->getSubraceFemale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_male_resistance_modifier(Race $race)
    {
        $this->assertSame(0, $race->getResistanceModifier($this->getSubraceMale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_female_resistance_modifier(Race $race)
    {
        $this->assertSame(0, $race->getResistanceModifier($this->getSubraceFemale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_male_senses_modifier(Race $race)
    {
        $this->assertSame(0, $race->getSensesModifier($this->getSubraceMale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_female_senses_modifier(Race $race)
    {
        $this->assertSame(0, $race->getSensesModifier($this->getSubraceFemale()));
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function has_infravision(Race $race)
    {
        $this->assertFalse($race->hasInfravision());
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function has_natural_regeneration(Race $race)
    {
        $this->assertFalse($race->hasNaturalRegeneration());
    }

    /**
     * @param Race $race
     *
     * @test
     * @depends can_create_self
     */
    public function requires_dungeon_master_agreement(Race $race)
    {
        $this->assertTrue($race->requiresDungeonMasterAgreement());
    }
}

/** inner */
class SomeGenderOfUnexpectedRace extends Gender
{
    /**
     * @return string
     */
    public static function getRaceCode()
    {
        return str_replace(__NAMESPACE__, '', __CLASS__);
    }

    /**
     * @return string
     */
    public static function getSubraceCode()
    {
        return __NAMESPACE__;
    }

    public static function isMale()
    {
        return true;
    }

    public static function isFemale()
    {
        return false;
    }

}

class SomeSubraceOfUnexpectedGenderSubrace extends Race {
    /**
     * @return string
     */
    public static function getRaceCode()
    {
        return SomeGenderOfUnexpectedRace::getRaceCode();
    }

    public static function getSubraceCode()
    {
        return SomeGenderOfUnexpectedRace::getSubraceCode() . 'foo';
    }
}
