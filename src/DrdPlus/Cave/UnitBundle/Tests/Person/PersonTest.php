<?php
namespace DrdPlus\Cave\UnitBundle\Person;

use DrdPlus\Cave\TablesBundle\Tables\Experiences\ExperiencesTable;
use DrdPlus\Cave\TablesBundle\Tables\Fatigue\FatigueTable;
use DrdPlus\Cave\TablesBundle\Tables\Tables;
use DrdPlus\Cave\TablesBundle\Tables\Weight\WeightTable;
use DrdPlus\Cave\TablesBundle\Tables\Wounds\WoundsTable;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Exceptionality;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\ExceptionalityProperties;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Experiences;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Name;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\NextLevelsProperties;
use DrdPlus\Cave\UnitBundle\Person\Background\Background;
use DrdPlus\Cave\UnitBundle\Person\Background\BackgroundSkills;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\LevelRank;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Person\Professions\Profession;
use DrdPlus\Cave\UnitBundle\Person\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Races\Race;
use DrdPlus\Cave\UnitBundle\Person\Skills\Skills;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

class PersonTest extends TestWithMockery
{

    /** @test */
    public function can_create_instance()
    {
        $instance = new Person(
            $this->createRace(),
            $this->createGender(),
            $this->createName(),
            $this->createExceptionality(),
            $this->createExperiences(),
            $professionLevels = $this->createProfessionLevels(),
            $this->createBackground(),
            $this->createSkills(),
            $this->createTables()
        );
        $this->assertNotNull($instance);
        $this->assertNull($instance->getId());
    }

    /** @test */
    public function returns_same_race_as_got()
    {
        $person = new Person(
            $race = $this->createRace(),
            $this->createGender(),
            $this->createName(),
            $this->createExceptionality(),
            $this->createExperiences(),
            $this->createProfessionLevels(),
            $this->createBackground(),
            $this->createSkills(),
            $this->createTables()
        );
        $this->assertSame($race, $person->getRace());
    }

    /** @test */
    public function returns_same_items_as_got()
    {
        $person = new Person(
            $race = $this->createRace(),
            $gender = $this->createGender(),
            $name = $this->createName(),
            $exceptionality = $this->createExceptionality(),
            $experiences = $this->createExperiences(),
            $professionLevels = $this->createProfessionLevels(),
            $background = $this->createBackground(),
            $skills = $this->createSkills(),
            $this->createTables()
        );
        $this->assertSame($race, $person->getRace());
        $this->assertSame($gender, $person->getGender());
        $this->assertSame($name, $person->getName());
        $this->assertSame($exceptionality, $person->getExceptionality());
        $this->assertSame($experiences, $person->getExperiences());
        $this->assertSame($professionLevels, $person->getProfessionLevels());
        $this->assertSame($background, $person->getBackground());
        $this->assertSame($skills, $person->getSkills());
        // note: tables are for inner purpose only, does not have getter
    }

    /** @test */
    public function can_change_name()
    {
        $person = new Person(
            $this->createRace(),
            $this->createGender(),
            $this->createName(),
            $this->createExceptionality(),
            $this->createExperiences(),
            $this->createProfessionLevels(),
            $this->createBackground(),
            $this->createSkills(),
            $this->createTables()
        );
        Name::registerSelf();
        $person->setName($name = Name::getEnum($nameString = 'foo'));
        $this->assertSame($name, $person->getName());
        $this->assertSame($nameString, (string)$person->getName());
        $person->setName($newName = Name::getEnum($newNameString = 'bar'));
        $this->assertSame($newName, $person->getName());
        $this->assertSame($newNameString, (string)$person->getName());
    }

    /**
     * @return Race
     */
    private function createRace()
    {
        $race = $this->mockery(Race::class);
        $race->shouldReceive('getStrengthModifier')
            ->atLeast()
            ->once()
            ->andReturn(0);
        $race->shouldReceive('getAgilityModifier')
            ->atLeast()
            ->once()
            ->andReturn(0);
        $race->shouldReceive('getKnackModifier')
            ->atLeast()
            ->once()
            ->andReturn(0);
        $race->shouldReceive('getWillModifier')
            ->atLeast()
            ->once()
            ->andReturn(0);
        $race->shouldReceive('getIntelligenceModifier')
            ->atLeast()
            ->once()
            ->andReturn(0);
        $race->shouldReceive('getCharismaModifier')
            ->atLeast()
            ->once()
            ->andReturn(0);
        $race->shouldReceive('getToughnessModifier')
            ->once()
            ->andReturn(0);
        $race->shouldReceive('getSizeModifier')
            ->once()
            ->andReturn(0);
        $race->shouldReceive('getSensesModifier')
            ->once()
            ->andReturn(0);
        $race->shouldReceive('getWeightInKg')
            ->once()
            ->andReturn(0);

        return $race;
    }

    /**
     * @return Gender
     */
    private function createGender()
    {
        return $this->mockery(Gender::class);
    }

    /**
     * @return Exceptionality
     */
    private function createExceptionality()
    {
        $exceptionality = $this->mockery(Exceptionality::class);
        $exceptionality->shouldReceive('getExceptionalityProperties')
            ->atLeast()
            ->once()
            ->andReturn($exceptionalityProperties = $this->mockery(ExceptionalityProperties::class));
        $exceptionalityProperties->shouldReceive('getStrength')
            ->atLeast()
            ->once()
            ->andReturn($strength = $this->mockery(Strength::class));
        $strength->shouldReceive('getValue')
            ->andReturn(0);
        $exceptionalityProperties->shouldReceive('getAgility')
            ->atLeast()
            ->once()
            ->andReturn($agility = $this->mockery(Agility::class));
        $agility->shouldReceive('getValue')
            ->andReturn(0);
        $exceptionalityProperties->shouldReceive('getKnack')
            ->atLeast()
            ->once()
            ->andReturn($knack = $this->mockery(Knack::class));
        $knack->shouldReceive('getValue')
            ->andReturn(0);
        $exceptionalityProperties->shouldReceive('getWill')
            ->once()
            ->andReturn($will = $this->mockery(Will::class));
        $will->shouldReceive('getValue')
            ->andReturn(0);
        $exceptionalityProperties->shouldReceive('getIntelligence')
            ->once()
            ->andReturn($intelligence = $this->mockery(Intelligence::class));
        $intelligence->shouldReceive('getValue')
            ->andReturn(0);
        $exceptionalityProperties->shouldReceive('getCharisma')
            ->once()
            ->andReturn($charisma = $this->mockery(Charisma::class));
        $charisma->shouldReceive('getValue')
            ->andReturn(0);

        return $exceptionality;
    }

    /**
     * @return Experiences
     */
    private function createExperiences()
    {
        $experiences = $this->mockery(Experiences::class);
        $experiences->shouldReceive('getValue')
            ->atLeast()->once()
            ->andReturn(0);

        return $experiences;
    }

    /**
     * @return ProfessionLevels
     */
    private function createProfessionLevels()
    {
        $professionLevels = $this->mockery(ProfessionLevels::class);

        $professionLevels->shouldReceive('getFirstLevel')->atLeast()->once()->andReturn($firstLevel = $this->mockery(ProfessionLevel::class));
        $firstLevel->shouldReceive('getProfession')->once()->andReturn($this->mockery(Profession::class));

        $professionLevels->shouldReceive('getStrengthModifierForFirstProfession')->atLeast()->once()->andReturn(0);
        $professionLevels->shouldReceive('getNextLevelsStrengthModifier')->atLeast()->once()->andReturn(0);

        $professionLevels->shouldReceive('getAgilityModifierForFirstProfession')->once()->andReturn(0);
        $professionLevels->shouldReceive('getNextLevelsAgilityModifier')->once()->andReturn(0);

        $professionLevels->shouldReceive('getKnackModifierForFirstProfession')->once()->andReturn(0);
        $professionLevels->shouldReceive('getNextLevelsKnackModifier')->once()->andReturn(0);

        $professionLevels->shouldReceive('getWillModifierForFirstProfession')->once()->andReturn(0);
        $professionLevels->shouldReceive('getNextLevelsWillModifier')->once()->andReturn(0);

        $professionLevels->shouldReceive('getIntelligenceModifierForFirstProfession')->once()->andReturn(0);
        $professionLevels->shouldReceive('getNextLevelsIntelligenceModifier')->once()->andReturn(0);

        $professionLevels->shouldReceive('getCharismaModifierForFirstProfession')->once()->andReturn(0);
        $professionLevels->shouldReceive('getNextLevelsCharismaModifier')->once()->andReturn(0);

        $professionLevels->shouldReceive('getWeightKgModifierForFirstLevel')->once()->andReturn(0);
        $professionLevels->shouldReceive('getNextLevelsWeightModifier')->once()->andReturn(0);

        $professionLevels->shouldReceive('getHighestLevelRank')->once()->andReturn($highestLevelRank = $this->mockery(LevelRank::class));
        $highestLevelRank->shouldReceive('getValue')->atLeast()->once()->andReturn(0);

        return $professionLevels;
    }

    /**
     * @return \Mockery\MockInterface|Background
     */
    private function createBackground()
    {
        $background = $this->mockery(Background::class);
        $background->shouldReceive('getBackgroundSkills')
            ->andReturn($backgroundSkills = $this->mockery(BackgroundSkills::class));

        return $background;
    }

    /**
     * @return \Mockery\MockInterface|Skills
     */
    private function createSkills()
    {
        $skills = $this->mockery(Skills::class);
        $skills->shouldReceive('checkSkillPoints')
            ->with(\Mockery::type(ProfessionLevel::class), \Mockery::type(BackgroundSkills::class), \Mockery::type(NextLevelsProperties::class))
            ->atLeast()->once();

        return $skills;
    }

    /**
     * @return Tables
     */
    private function createTables()
    {
        $tables = $this->mockery(Tables::class);

        $tables->shouldReceive('getWeightTable')
            ->once()
            ->andReturn($weightTable = $this->mockery(WeightTable::class));
        $tables->shouldReceive('getWoundsTable')
            ->atLeast()->once()
            ->andReturn($fatigueTable = $this->mockery(WoundsTable::class));
        $fatigueTable->shouldReceive('toWounds')
            ->with(\Mockery::type('int'))
            ->atLeast()->once()
            ->andReturn(10);
        $tables->shouldReceive('getFatigueTable')
            ->atLeast()->once()
            ->andReturn($fatigueTable = $this->mockery(FatigueTable::class));
        $fatigueTable->shouldReceive('toFatigue')
            ->with(\Mockery::type('int'))
            ->atLeast()->once()
            ->andReturn(10);
        $tables->shouldReceive('getExperiencesTable')
            ->atLeast()->once()
            ->andReturn($experiencesTable = $this->mockery(ExperiencesTable::class));
        $experiencesTable->shouldReceive('levelToTotalExperiences')
            ->once()
            ->with(0)
            ->andReturn(0);

        return $tables;
    }

    /**
     * @return Name
     */
    private function createName()
    {
        return $this->mockery(Name::class);
    }
}
