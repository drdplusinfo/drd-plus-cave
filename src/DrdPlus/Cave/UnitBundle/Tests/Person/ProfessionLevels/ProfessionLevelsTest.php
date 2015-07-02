<?php
namespace DrdPlus\Cave\UnitBundle\Person\ProfessionLevels;

use Doctrine\Common\Collections\ArrayCollection;
use DrdPlus\Cave\UnitBundle\Person\Professions\Fighter;
use DrdPlus\Cave\UnitBundle\Person\Professions\Priest;
use DrdPlus\Cave\UnitBundle\Person\Professions\Profession;
use DrdPlus\Cave\UnitBundle\Person\Professions\Ranger;
use DrdPlus\Cave\UnitBundle\Person\Professions\Theurgist;
use DrdPlus\Cave\UnitBundle\Person\Professions\Thief;
use DrdPlus\Cave\UnitBundle\Person\Professions\Wizard;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\BaseProperty;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Person\Person;
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

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_first_level_strength_increment(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getStrengthModifierForFirstProfession());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_strength_increment_summary(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getStrengthModifierSummary());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_first_level_agility_increment(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getAgilityModifierForFirstProfession());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_agility_increment_summary(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getAgilityModifierSummary());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_first_level_knack_increment(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getKnackModifierForFirstProfession());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_knack_increment_summary(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getKnackModifierSummary());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_first_level_will_increment(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getWillModifierForFirstProfession());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_will_increment_summary(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getWillModifierSummary());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_first_level_intelligence_increment(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getIntelligenceModifierForFirstProfession());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_intelligence_increment_summary(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getIntelligenceModifierSummary());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_first_level_charisma_increment(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getCharismaModifierForFirstProfession());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_zero_charisma_increment_summary(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame(0, $professionLevels->getCharismaModifierSummary());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_empty_array_as_levels(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertSame([], $professionLevels->getLevels());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_false_as_first_level(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertFalse($professionLevels->getFirstLevel());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_empty_array_collection_as_fighter_levels(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $levels = $professionLevels->getFighterLevels();
        $this->assertInstanceOf(ArrayCollection::class, $levels);
        $this->isEmpty($levels->toArray());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_empty_array_collection_as_priest_levels(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $levels = $professionLevels->getPriestLevels();
        $this->assertInstanceOf(ArrayCollection::class, $levels);
        $this->isEmpty($levels->toArray());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_empty_array_collection_as_ranger_levels(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $levels = $professionLevels->getRangerLevels();
        $this->assertInstanceOf(ArrayCollection::class, $levels);
        $this->isEmpty($levels->toArray());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_empty_array_collection_as_theurgist_levels(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $levels = $professionLevels->getTheurgistLevels();
        $this->assertInstanceOf(ArrayCollection::class, $levels);
        $this->isEmpty($levels->toArray());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_empty_array_collection_as_thief_levels(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $levels = $professionLevels->getThiefLevels();
        $this->assertInstanceOf(ArrayCollection::class, $levels);
        $this->isEmpty($levels->toArray());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_empty_array_collection_as_wizard_levels(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $levels = $professionLevels->getWizardLevels();
        $this->assertInstanceOf(ArrayCollection::class, $levels);
        $this->isEmpty($levels->toArray());
    }

    /*
     * PERSON
     */


    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return ProfessionLevels
     *
     * @test
     * @depends can_create_instance
     */
    public function new_levels_gives_null_as_person(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertNull($professionLevels->getPerson());

        return $professionLevels;
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return ProfessionLevels
     *
     * @test
     * @depends new_levels_gives_null_as_person
     */
    public function person_can_be_set(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertNull($professionLevels->getPerson());
        /** @var Person|\Mockery\MockInterface $person */
        $person = \Mockery::mock(Person::class);
        $person->shouldReceive('getProfessionLevels')
            ->atLeast()->once()
            ->andReturn($professionLevels);
        $professionLevels->setPerson($person);
        $this->assertSame($person, $professionLevels->getPerson());

        return $professionLevels;
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return ProfessionLevels
     *
     * @test
     * @depends person_can_be_set
     */
    public function same_person_can_be_set(ProfessionLevels $professionLevels)
    {
        /** @var ProfessionLevelsTest $this */
        $this->assertInstanceOf(Person::class, $professionLevels->getPerson());
        /** @var Person|\Mockery\MockInterface $person */
        $person = $professionLevels->getPerson();
        $person->shouldReceive('getId')
            ->andReturn(123);
        $professionLevels->setPerson($person);
        $this->assertSame($person, $professionLevels->getPerson());

        return $professionLevels;
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends person_can_be_set
     * @expectedException \LogicException
     */
    public function another_person_cause_exception(ProfessionLevels $professionLevels)
    {
        /** @var Person|\Mockery\MockInterface $previousPerson */
        $previousPerson = $professionLevels->getPerson();
        $previousPerson->shouldReceive('getId')
            ->andReturn(123);
        /** @var ProfessionLevelsTest $this */
        $this->assertInstanceOf(Person::class, $professionLevels->getPerson());
        /** @var Person|\Mockery\MockInterface $anotherPerson */
        $anotherPerson = \Mockery::mock(Person::class);
        $anotherPerson->shouldReceive('getId')
            ->andReturn(321);
        $anotherPerson->shouldReceive('getProfessionLevels')
            ->andReturn($professionLevels);
        $professionLevels->setPerson($anotherPerson);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends person_can_be_set
     * @expectedException \LogicException
     */
    public function another_person_even_without_id_cause_exception(ProfessionLevels $professionLevels)
    {
        /** @var Person|\Mockery\MockInterface $previousPerson */
        $previousPerson = $professionLevels->getPerson();
        $previousPerson->shouldReceive('getId')
            ->andReturnNull(); // no ID at all - not saved yet
        /** @var ProfessionLevelsTest $this */
        $this->assertInstanceOf(Person::class, $professionLevels->getPerson());
        /** @var Person|\Mockery\MockInterface $anotherPerson */
        $anotherPerson = \Mockery::mock(Person::class);
        $anotherPerson->shouldReceive('getId')
            ->andReturnNull(); // again not saved entity
        $anotherPerson->shouldReceive('getProfessionLevels')
            ->andReturn($professionLevels);
        $professionLevels->setPerson($anotherPerson);
    }

    /*
     * FIRST LEVELS
     */


    /**
     * @test
     * @depends can_create_instance
     */
    public function fighter_level_can_be_added()
    {
        return $this->levelCanBeAdded('fighter');
    }

    /**
     * @param string $professionName
     *
     * @return ProfessionLevels
     */
    private function levelCanBeAdded($professionName)
    {
        $professionLevels = new ProfessionLevels();
        /** @var \Mockery\MockInterface|ProfessionLevel $professionLevel */
        $professionLevel = \Mockery::mock($this->getFirstLevelsProfessionLevelClass($professionName));
        $professionLevel->shouldReceive('getProfession')
            ->andReturn($profession = \Mockery::mock(Profession::class));
        $profession->shouldReceive('getName')
            ->andReturn($professionName);
        $professionLevel->shouldReceive('getLevelValue')
            ->atLeast()->once()
            ->andReturn($levelValue = \Mockery::mock(LevelValue::class));
        $levelValue->shouldReceive('getValue')
            ->atLeast()->once()
            ->andReturn(1);
        $adder = 'add' . ucfirst($professionName) . 'Level';
        $professionLevels->$adder($professionLevel);
        $this->assertSame($professionLevel, $professionLevels->getFirstLevel());
        $levelsGetter = 'get' . ucfirst($professionName) . 'levels';
        $this->assertSame([$professionLevel], $professionLevels->$levelsGetter()->toArray());
        $this->assertSame([$professionLevel], $professionLevels->getLevels());

        return $professionLevels;
    }

    private function getFirstLevelsProfessionLevelClass($professionName)
    {
        return '\DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\\'
        . ucfirst($professionName) . 'Level';
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends fighter_level_can_be_added
     */
    public function fighter_at_first_level_has_strength_and_agility_increment(ProfessionLevels $professionLevels)
    {
        $this->askFirstLevelForPrimaryPropertiesIncrement(Fighter::FIGHTER, $professionLevels);
    }

    private function askFirstLevelForPrimaryPropertiesIncrement(
        $professionName,
        ProfessionLevels $professionLevels
    )
    {
        /** @var FighterLevel|\Mockery\MockInterface $firstLevel */
        $firstLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf($this->getFirstLevelsProfessionLevelClass($professionName), $firstLevel);
        foreach ([Strength::STRENGTH, Agility::AGILITY, Knack::KNACK, Will::WILL, Intelligence::INTELLIGENCE, Charisma::CHARISMA] as $propertyName) {
            $firstLevel->shouldReceive('get' . ucfirst($propertyName) . 'Increment')
                ->atLeast()->once()
                ->andReturn($increment = \Mockery::mock(BaseProperty::class));
            $increment->shouldReceive('getValue')
                ->atLeast()->once()
                ->andReturn($this->isPrimaryProperty($propertyName, $professionName) ? ProfessionLevel::PROPERTY_FIRST_LEVEL_MODIFIER : 0);
        }
        $professionLevels->getStrengthModifierForFirstProfession();
        $professionLevels->getAgilityModifierForFirstProfession();
        $professionLevels->getKnackModifierForFirstProfession();
        $professionLevels->getWillModifierForFirstProfession();
        $professionLevels->getIntelligenceModifierForFirstProfession();
        $professionLevels->getCharismaModifierForFirstProfession();
    }

    /**
     * @param string $propertyName
     * @param string $professionName
     *
     * @return bool
     */
    private function isPrimaryProperty($propertyName, $professionName)
    {
        return in_array($propertyName, $this->getPrimaryProperties($professionName));
    }

    private function getPrimaryProperties($professionName)
    {
        switch ($professionName) {
            case Fighter::FIGHTER :
                return [Strength::STRENGTH, Agility::AGILITY];
            case Priest::PRIEST :
                return [Will::WILL, Charisma::CHARISMA];
            case Ranger::RANGER :
                return [Strength::STRENGTH, Knack::KNACK];
            case Theurgist::THEURGIST :
                return [Intelligence::INTELLIGENCE, Charisma::CHARISMA];
            case Thief::THIEF :
                return [Knack::KNACK, Agility::AGILITY];
            case Wizard::WIZARD :
                return [Will::WILL, Intelligence::INTELLIGENCE];
            default :
                throw new \RuntimeException('Unknown profession name ' . var_export($professionName, true));
        }
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends fighter_level_can_be_added
     * @expectedException \LogicException
     */
    public function fighter_missing_level_value_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->missingLevelValueCauseException('fighter', $professionLevels);
    }

    /**
     * @param string $professionName
     * @param ProfessionLevels $professionLevels
     *
     * @return ProfessionLevels
     */
    private function missingLevelValueCauseException($professionName, ProfessionLevels $professionLevels)
    {
        /** @var \Mockery\MockInterface|ProfessionLevel $professionLevel */
        $professionLevel = \Mockery::mock($this->getFirstLevelsProfessionLevelClass($professionName));
        $professionLevel->shouldReceive('getProfession')
            ->andReturn($profession = \Mockery::mock(Profession::class));
        $profession->shouldReceive('getName')
            ->andReturn($professionName);
        $professionLevel->shouldReceive('getLevelValue')
            ->atLeast()->once()
            ->andReturn($levelValue = \Mockery::mock(LevelValue::class));
        $levelValue->shouldReceive('getValue')
            ->atLeast()->once()
            ->andReturn(0);
        $professionLevel->shouldReceive('getId')
            ->andReturn('foo');
        $adder = 'add' . ucfirst($professionName) . 'Level';
        $professionLevels->$adder($professionLevel);
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function priest_level_can_be_added()
    {
        return $this->levelCanBeAdded('priest');
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends priest_level_can_be_added
     */
    public function priest_at_first_level_has_will_and_charisma_increment(ProfessionLevels $professionLevels)
    {
        $this->askFirstLevelForPrimaryPropertiesIncrement('priest', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends priest_level_can_be_added
     * @expectedException \LogicException
     */
    public function priest_missing_level_value_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->missingLevelValueCauseException('priest', $professionLevels);
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function ranger_level_can_be_added()
    {
        return $this->levelCanBeAdded('ranger');
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends ranger_level_can_be_added
     */
    public function ranger_at_first_level_has_strength_and_knack_increment(ProfessionLevels $professionLevels)
    {
        $this->askFirstLevelForPrimaryPropertiesIncrement('ranger', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends ranger_level_can_be_added
     * @expectedException \LogicException
     */
    public function ranger_missing_level_value_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->missingLevelValueCauseException('ranger', $professionLevels);
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function theurgist_level_can_be_added()
    {
        return $this->levelCanBeAdded('theurgist');
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends theurgist_level_can_be_added
     */
    public function theurgist_at_first_level_has_intelligence_and_charisma_increment(ProfessionLevels $professionLevels)
    {
        $this->askFirstLevelForPrimaryPropertiesIncrement('theurgist', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends theurgist_level_can_be_added
     * @expectedException \LogicException
     */
    public function theurgist_missing_level_value_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->missingLevelValueCauseException('theurgist', $professionLevels);
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function thief_level_can_be_added()
    {
        return $this->levelCanBeAdded('thief');
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends thief_level_can_be_added
     */
    public function thief_at_first_level_has_agility_and_knack_increment(ProfessionLevels $professionLevels)
    {
        $this->askFirstLevelForPrimaryPropertiesIncrement('thief', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends thief_level_can_be_added
     * @expectedException \LogicException
     */
    public function thief_missing_level_value_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->missingLevelValueCauseException('thief', $professionLevels);
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function wizard_level_can_be_added()
    {
        return $this->levelCanBeAdded('wizard');
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends wizard_level_can_be_added
     */
    public function wizard_at_first_level_has_will_and_intelligence_increment(ProfessionLevels $professionLevels)
    {
        $this->askFirstLevelForPrimaryPropertiesIncrement('wizard', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends wizard_level_can_be_added
     * @expectedException \LogicException
     */
    public function wizard_missing_level_value_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->missingLevelValueCauseException('wizard', $professionLevels);
    }

    /*
     * MORE LEVELS
     */


    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return ProfessionLevels
     *
     * @test
     * @depends fighter_level_can_be_added
     */
    public function more_fighter_levels_can_be_added(ProfessionLevels $professionLevels)
    {
        $professionLevels = $this->moreLevelsCanBeAdded(Fighter::FIGHTER, $professionLevels);

        return $professionLevels;
    }

    private function moreLevelsCanBeAdded(
        $professionName,
        ProfessionLevels $professionLevels
    )
    {
        /** @var FighterLevel|\Mockery\MockInterface $firstLevel */
        $firstLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf($this->geProfessionLevelClass($professionName), $firstLevel);
        $this->assertSame(1, count($professionLevels->getLevels()));

        /** @var LevelValue|\Mockery\MockInterface $firstLevelValue */
        $firstLevelValue = $firstLevel->getLevelValue();
        $firstLevelValue->shouldReceive('getValue')
            ->atLeast()->once()
            ->andReturn(1);
        $firstLevel->shouldReceive('isFirstLevel')
            ->andReturn(true);
        /** @var FighterLevel|\Mockery\MockInterface $nextLevel */
        $nextLevel = \Mockery::mock($this->geProfessionLevelClass($professionName));
        $nextLevel->shouldReceive('getProfession')
            ->andReturn($profession = \Mockery::mock(Profession::class));
        $profession->shouldReceive('getName')
            ->atLeast()->once()
            ->andReturn($professionName);
        $nextLevel->shouldReceive('getLevelValue')
            ->atLeast()->once()
            ->andReturn($nextLevelValue = \Mockery::mock(LevelValue::class));
        $nextLevelValue->shouldReceive('getValue')
            ->atLeast()->once()
            ->andReturn(2);
        $nextLevel->shouldReceive('isFirstLevel')
            ->andReturn(false);

        $addProfessionLevel = 'add' . ucfirst($professionName) . 'Level';
        $professionLevels->$addProfessionLevel($nextLevel);

        $this->assertSame($firstLevel, $professionLevels->getFirstLevel(), 'After adding a new level the old one is no more the first.');
        $getProfessionLevel = 'get' . ucfirst($professionName) . 'Levels';
        $this->assertSame([$firstLevel, $nextLevel], $professionLevels->$getProfessionLevel()->toArray(), 'Expected only first and last levels of the same profession.');
        $this->assertSame([$firstLevel, $nextLevel], $professionLevels->getLevels(), 'Expected only first and last levels of the same profession.');

        return $professionLevels;
    }

    private function geProfessionLevelClass($professionName)
    {
        $abstractClass = ProfessionLevel::class;

        return preg_replace('~ProfessionLevel$~', ucfirst($professionName) . 'Level', $abstractClass);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_fighter_levels_can_be_added
     */
    public function fighter_has_properties_increment_summary_as_expected(ProfessionLevels $professionLevels)
    {
        $this->professionHasPropertiesModifierSummaryAsExpected(Fighter::FIGHTER, $professionLevels);
    }

    private function professionHasPropertiesModifierSummaryAsExpected($professionName, ProfessionLevels $professionLevels)
    {
        foreach ([Strength::STRENGTH, Agility::AGILITY, Knack::KNACK, Will::WILL, Intelligence::INTELLIGENCE, Charisma::CHARISMA] as $propertyName) {
            $this->professionHasPropertyModifierSummaryAsExpected($professionName, $propertyName, $professionLevels);
        }
    }

    private function professionHasPropertyModifierSummaryAsExpected(
        $professionName,
        $propertyName,
        ProfessionLevels $professionLevels
    )
    {
        $propertySummary = 0;
        foreach ($professionLevels as $level) {
            /** @var ProfessionLevel|\Mockery\MockInterface $level */
            if (!$level->isFirstLevel()) {
                $level->shouldReceive('get' . ucfirst($propertyName) . 'Increment')
                    ->atLeast()->once()
                    ->andReturn($propertyIncrement = \Mockery::mock(BaseProperty::class));
                $propertyIncrement->shouldReceive('getValue')
                    ->atLeast()->once()
                    ->andReturn($propertyValue = 123);
                $propertySummary += $propertyValue;
            }
        }
        $getPropertyModifierSummary = 'get' . ucfirst($propertyName) . 'ModifierSummary';
        $this->assertSame(
            ($this->isPrimaryProperty($propertyName, $professionName) ? 1 : 0) + $propertySummary,
            $professionLevels->$getPropertyModifierSummary(),
            "The modifier summary of property $propertyName should be " . (($this->isPrimaryProperty($propertyName, $professionName) ? 1 : 0) + $propertySummary) .
            " for $professionName, got " . $professionLevels->$getPropertyModifierSummary()
        );
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_fighter_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_fighter_level_with_occupied_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithOccupiedSequenceCauseException(Fighter::FIGHTER, $professionLevels);
    }

    private function addingLevelWithOccupiedSequenceCauseException(
        $professionName,
        ProfessionLevels $professionLevels
    )
    {
        $this->assertSame(2, count($professionLevels->getLevels()));
        /** @var FighterLevel|\Mockery\MockInterface $anotherLevel */

        $anotherLevel = \Mockery::mock($this->geProfessionLevelClass($professionName));
        $anotherLevel->shouldReceive('getProfession')
            ->andReturn($profession = \Mockery::mock(Profession::class));
        $profession->shouldReceive('getName')
            ->andReturn($professionName);
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getValue')
            ->andReturn(2 /* already occupied level rank */);

        $adder = 'add' . ucfirst($professionName) . 'Level';
        $professionLevels->$adder($anotherLevel);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_fighter_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_fighter_level_with_too_high_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithTooHighSequenceCauseException(Fighter::FIGHTER, $professionLevels);
    }

    private function addingLevelWithTooHighSequenceCauseException(
        $professionName,
        ProfessionLevels $professionLevels
    )
    {
        $this->assertSame(2, count($professionLevels->getLevels()));

        /** @var FighterLevel|\Mockery\MockInterface $anotherLevel */
        $anotherLevel = \Mockery::mock($this->geProfessionLevelClass($professionName));
        $anotherLevel->shouldReceive('getProfession')
            ->andReturn($profession = \Mockery::mock(Profession::class));
        $profession->shouldReceive('getName')
            ->andReturn($professionName);
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $anotherLevelValue->shouldReceive('getValue')
            ->andReturn(4 /* skipped rank 3 */);

        $adder = 'add' . ucfirst($professionName) . 'Level';
        $professionLevels->$adder($anotherLevel);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_fighter_levels_can_be_added
     * @expectedException \LogicException
     */
    public function changed_fighter_level_during_usage_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->changedLevelDuringUsageCauseException(Fighter::FIGHTER, $professionLevels);
    }

    private function changedLevelDuringUsageCauseException(
        $professionName,
        ProfessionLevels $professionLevels
    )
    {
        $this->assertSame(2, count($professionLevels->getLevels()));
        /** @var FighterLevel|\Mockery\MockInterface $anotherLevel */
        $anotherLevel = \Mockery::mock($this->geProfessionLevelClass($professionName));
        $anotherLevel->shouldReceive('getProfession')
            ->andReturn($profession = \Mockery::mock(Profession::class));
        $profession->shouldReceive('getName')
            ->andReturn(Fighter::FIGHTER);
        $anotherLevel->shouldReceive('getLevelValue')
            ->andReturn($anotherLevelValue = \Mockery::mock(LevelValue::class));
        $rank = 3;
        $anotherLevelValue->shouldReceive('getValue')
            ->andReturnUsing($rankGetter = function () use (&$rank) {
                return $rank;
            });

        $adder = 'add' . ucfirst($professionName) . 'Level';
        $professionLevels->$adder($anotherLevel);
        /** @noinspection PhpUnusedLocalVariableInspection */
        $rank = 1; // changed rank to already occupied value

        $professionLevels->getFirstLevel();
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return ProfessionLevels
     *
     * @test
     * @depends priest_level_can_be_added
     */
    public function more_priest_levels_can_be_added(ProfessionLevels $professionLevels)
    {
        return $this->moreLevelsCanBeAdded('priest', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_priest_levels_can_be_added
     */
    public function priest_has_properties_modifier_summary_as_expected(ProfessionLevels $professionLevels)
    {
        $this->professionHasPropertiesModifierSummaryAsExpected('priest', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_priest_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_priest_level_with_occupied_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithOccupiedSequenceCauseException('priest', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_priest_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_priest_level_with_too_high_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithTooHighSequenceCauseException('priest', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_priest_levels_can_be_added
     * @expectedException \LogicException
     */
    public function changed_priest_level_during_usage_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->changedLevelDuringUsageCauseException('priest', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return ProfessionLevels
     *
     * @test
     * @depends ranger_level_can_be_added
     */
    public function more_ranger_levels_can_be_added(ProfessionLevels $professionLevels)
    {
        return $this->moreLevelsCanBeAdded('ranger', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_ranger_levels_can_be_added
     */
    public function ranger_has_properties_modifier_summary_as_expected(ProfessionLevels $professionLevels)
    {
        $this->professionHasPropertiesModifierSummaryAsExpected('ranger', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_ranger_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_ranger_level_with_occupied_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithOccupiedSequenceCauseException('ranger', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_ranger_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_ranger_level_with_too_high_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithTooHighSequenceCauseException('ranger', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_ranger_levels_can_be_added
     * @expectedException \LogicException
     */
    public function changed_ranger_level_during_usage_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->changedLevelDuringUsageCauseException('ranger', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return ProfessionLevels
     *
     * @test
     * @depends theurgist_level_can_be_added
     */
    public function more_theurgist_levels_can_be_added(ProfessionLevels $professionLevels)
    {
        return $this->moreLevelsCanBeAdded('theurgist', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_theurgist_levels_can_be_added
     */
    public function theurgist_has_properties_modifier_summary_as_expected(ProfessionLevels $professionLevels)
    {
        $this->professionHasPropertiesModifierSummaryAsExpected('theurgist', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_theurgist_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_theurgist_level_with_occupied_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithOccupiedSequenceCauseException('theurgist', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_theurgist_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_theurgist_level_with_too_high_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithTooHighSequenceCauseException('theurgist', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_theurgist_levels_can_be_added
     * @expectedException \LogicException
     */
    public function changed_theurgist_level_during_usage_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->changedLevelDuringUsageCauseException('theurgist', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return ProfessionLevels
     *
     * @test
     * @depends thief_level_can_be_added
     */
    public function more_thief_levels_can_be_added(ProfessionLevels $professionLevels)
    {
        return $this->moreLevelsCanBeAdded('thief', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_thief_levels_can_be_added
     */
    public function thief_has_properties_modifier_summary_as_expected(ProfessionLevels $professionLevels)
    {
        $this->professionHasPropertiesModifierSummaryAsExpected('thief', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_thief_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_thief_level_with_occupied_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithOccupiedSequenceCauseException('thief', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_thief_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_thief_level_with_too_high_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithTooHighSequenceCauseException('thief', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_thief_levels_can_be_added
     * @expectedException \LogicException
     */
    public function changed_thief_level_during_usage_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->changedLevelDuringUsageCauseException('thief', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return ProfessionLevels
     *
     * @test
     * @depends wizard_level_can_be_added
     */
    public function more_wizard_levels_can_be_added(ProfessionLevels $professionLevels)
    {
        return $this->moreLevelsCanBeAdded('wizard', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_wizard_levels_can_be_added
     */
    public function wizard_has_properties_modifier_summary_as_expected(ProfessionLevels $professionLevels)
    {
        $this->professionHasPropertiesModifierSummaryAsExpected('wizard', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_wizard_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_wizard_level_with_occupied_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithOccupiedSequenceCauseException('wizard', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_wizard_levels_can_be_added
     * @expectedException \LogicException
     */
    public function adding_wizard_level_with_too_high_sequence_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->addingLevelWithTooHighSequenceCauseException('wizard', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends more_wizard_levels_can_be_added
     * @expectedException \LogicException
     */
    public function changed_wizard_level_during_usage_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->changedLevelDuringUsageCauseException('wizard', $professionLevels);
    }

    /*
     * ONLY SINGLE PROFESSION IS ALLOWED
     */


    /**
     * @var \Mockery\MockInterface[]|ProfessionLevel[]|array $levels
     */
    private $professionLevels = [];

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends fighter_level_can_be_added
     * @expectedException \LogicException
     */
    public function other_professions_to_fighter_levels_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->otherProfessionsCauseException('fighter', $professionLevels);
    }

    private function otherProfessionsCauseException(
        $professionName,
        ProfessionLevels $professionLevels
    )
    {
        /** @var FighterLevel|\Mockery\MockInterface $firstLevel */
        $firstLevel = $professionLevels->getFirstLevel();
        $this->assertInstanceOf($this->getMultiProfessionTestLevelClass($professionName), $firstLevel);

        $exception = new \Exception('No other professions than ' . $firstLevel->getProfession()->getName() . '?');
        foreach ($this->getLevelsExcept($firstLevel) as $professionCode => $otherProfessionLevel) {
            $adder = 'add' . ucfirst($professionCode) . 'Level';
            try {
                $professionLevels->$adder($otherProfessionLevel);
                $this->fail("Adding $professionCode to levels already set to {$firstLevel->getProfession()->getName()} should throw exception.");
            } catch (\LogicException $exception) {
                $this->assertNotNull($exception);
            }
        }

        throw $exception;
    }

    private function getMultiProfessionTestLevelClass($professionName)
    {
        return '\DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\\'
        . ucfirst($professionName) . 'Level';
    }

    /**
     * @param ProfessionLevel $excludedProfession
     *
     * @return \Mockery\MockInterface[]|ProfessionLevel[]
     */
    private function getLevelsExcept(ProfessionLevel $excludedProfession)
    {
        if (empty($this->professionLevels)) {
            $this->buildProfessionLevels();
        }

        return array_filter(
            $this->professionLevels,
            function (ProfessionLevel $level) use ($excludedProfession) {
                return $level->getProfession()->getName() !== $excludedProfession->getProfession()->getName();
            }
        );
    }

    private function buildProfessionLevels()
    {
        $this->professionLevels['fighter'] = \Mockery::mock(FighterLevel::class);
        $this->professionLevels['priest'] = \Mockery::mock(PriestLevel::class);
        $this->professionLevels['ranger'] = \Mockery::mock(RangerLevel::class);
        $this->professionLevels['theurgist'] = \Mockery::mock(TheurgistLevel::class);
        $this->professionLevels['thief'] = \Mockery::mock(ThiefLevel::class);
        $this->professionLevels['wizard'] = \Mockery::mock(WizardLevel::class);
        foreach ($this->professionLevels as $professionCode => $level) {
            $level->shouldReceive('getProfession')
                ->andReturn($profession = \Mockery::mock(Profession::class));
            $profession->shouldReceive('getName')
                ->andReturn($professionCode);
        }
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends priest_level_can_be_added
     * @expectedException \LogicException
     */
    public function other_professions_to_priest_levels_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->otherProfessionsCauseException('priest', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends ranger_level_can_be_added
     * @expectedException \LogicException
     */
    public function other_professions_to_ranger_levels_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->otherProfessionsCauseException('ranger', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends theurgist_level_can_be_added
     * @expectedException \LogicException
     */
    public function other_professions_to_theurgist_levels_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->otherProfessionsCauseException('theurgist', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends thief_level_can_be_added
     * @expectedException \LogicException
     */
    public function other_professions_to_thief_levels_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->otherProfessionsCauseException('thief', $professionLevels);
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @test
     * @depends wizard_level_can_be_added
     * @expectedException \LogicException
     */
    public function other_professions_to_wizard_levels_cause_exception(ProfessionLevels $professionLevels)
    {
        $this->otherProfessionsCauseException('wizard', $professionLevels);
    }

}
