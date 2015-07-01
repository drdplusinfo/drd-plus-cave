<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Background;

use DrdPlus\Cave\UnitBundle\Person\Background\BackgroundSkillsTable;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

class BackgroundSkillsTableTest extends TestWithMockery
{
    /**
     * @test
     */
    public function can_give_fighter_physical_skill_points()
    {
        $table = new BackgroundSkillsTable();

        $this->assertSame(2, $table->getFighterPhysicalSkillPoints(0));
        $this->assertSame(3, $table->getFighterPhysicalSkillPoints(1));
        $this->assertSame(4, $table->getFighterPhysicalSkillPoints(2));
        $this->assertSame(4, $table->getFighterPhysicalSkillPoints(3));
        $this->assertSame(5, $table->getFighterPhysicalSkillPoints(4));
        $this->assertSame(6, $table->getFighterPhysicalSkillPoints(5));
        $this->assertSame(8, $table->getFighterPhysicalSkillPoints(6));
        $this->assertSame(10, $table->getFighterPhysicalSkillPoints(7));
        $this->assertSame(12, $table->getFighterPhysicalSkillPoints(8));
    }

    /**
     * @test
     */
    public function can_give_fighter_psychical_skill_points()
    {
        $table = new BackgroundSkillsTable();

        $this->assertSame(0, $table->getFighterPsychicalSkillPoints(0));
        $this->assertSame(0, $table->getFighterPsychicalSkillPoints(1));
        $this->assertSame(0, $table->getFighterPsychicalSkillPoints(2));
        $this->assertSame(1, $table->getFighterPsychicalSkillPoints(3));
        $this->assertSame(1, $table->getFighterPsychicalSkillPoints(4));
        $this->assertSame(2, $table->getFighterPsychicalSkillPoints(5));
        $this->assertSame(2, $table->getFighterPsychicalSkillPoints(6));
        $this->assertSame(3, $table->getFighterPsychicalSkillPoints(7));
        $this->assertSame(4, $table->getFighterPsychicalSkillPoints(8));
    }
    
    /**
     * @test
     */
    public function can_give_fighter_combined_skill_points()
    {
        $table = new BackgroundSkillsTable();

        $this->assertSame(1, $table->getFighterCombinedSkillPoints(0));
        $this->assertSame(1, $table->getFighterCombinedSkillPoints(1));
        $this->assertSame(1, $table->getFighterCombinedSkillPoints(2));
        $this->assertSame(2, $table->getFighterCombinedSkillPoints(3));
        $this->assertSame(3, $table->getFighterCombinedSkillPoints(4));
        $this->assertSame(3, $table->getFighterCombinedSkillPoints(5));
        $this->assertSame(4, $table->getFighterCombinedSkillPoints(6));
        $this->assertSame(5, $table->getFighterCombinedSkillPoints(7));
        $this->assertSame(6, $table->getFighterCombinedSkillPoints(8));
    }

    /**
     * @test
     */
    public function can_give_thief_physical_skill_points()
    {
        $table = new BackgroundSkillsTable();

        $this->assertSame(1, $table->getThiefPhysicalSkillPoints(0));
        $this->assertSame(2, $table->getThiefPhysicalSkillPoints(1));
        $this->assertSame(2, $table->getThiefPhysicalSkillPoints(2));
        $this->assertSame(3, $table->getThiefPhysicalSkillPoints(3));
        $this->assertSame(4, $table->getThiefPhysicalSkillPoints(4));
        $this->assertSame(5, $table->getThiefPhysicalSkillPoints(5));
        $this->assertSame(6, $table->getThiefPhysicalSkillPoints(6));
        $this->assertSame(8, $table->getThiefPhysicalSkillPoints(7));
        $this->assertSame(9, $table->getThiefPhysicalSkillPoints(8));
    }

    /**
     * @test
     */
    public function can_give_thief_psychical_skill_points()
    {
        $table = new BackgroundSkillsTable();

        $this->assertSame(1, $table->getThiefPsychicalSkillPoints(0));
        $this->assertSame(1, $table->getThiefPsychicalSkillPoints(1));
        $this->assertSame(1, $table->getThiefPsychicalSkillPoints(2));
        $this->assertSame(2, $table->getThiefPsychicalSkillPoints(3));
        $this->assertSame(2, $table->getThiefPsychicalSkillPoints(4));
        $this->assertSame(2, $table->getThiefPsychicalSkillPoints(5));
        $this->assertSame(3, $table->getThiefPsychicalSkillPoints(6));
        $this->assertSame(4, $table->getThiefPsychicalSkillPoints(7));
        $this->assertSame(6, $table->getThiefPsychicalSkillPoints(8));
    }

    /**
     * @test
     */
    public function can_give_thief_combined_skill_points()
    {
        $table = new BackgroundSkillsTable();

        $this->assertSame(1, $table->getThiefCombinedSkillPoints(0));
        $this->assertSame(1, $table->getThiefCombinedSkillPoints(1));
        $this->assertSame(2, $table->getThiefCombinedSkillPoints(2));
        $this->assertSame(2, $table->getThiefCombinedSkillPoints(3));
        $this->assertSame(3, $table->getThiefCombinedSkillPoints(4));
        $this->assertSame(4, $table->getThiefCombinedSkillPoints(5));
        $this->assertSame(5, $table->getThiefCombinedSkillPoints(6));
        $this->assertSame(6, $table->getThiefCombinedSkillPoints(7));
        $this->assertSame(7, $table->getThiefCombinedSkillPoints(8));
    }

    /**
     * @test
     */
    public function can_give_ranger_physical_skill_points()
    {
        $table = new BackgroundSkillsTable();

        $this->assertSame(2, $table->getRangerPhysicalSkillPoints(0));
        $this->assertSame(2, $table->getRangerPhysicalSkillPoints(1));
        $this->assertSame(3, $table->getRangerPhysicalSkillPoints(2));
        $this->assertSame(3, $table->getRangerPhysicalSkillPoints(3));
        $this->assertSame(4, $table->getRangerPhysicalSkillPoints(4));
        $this->assertSame(5, $table->getRangerPhysicalSkillPoints(5));
        $this->assertSame(6, $table->getRangerPhysicalSkillPoints(6));
        $this->assertSame(8, $table->getRangerPhysicalSkillPoints(7));
        $this->assertSame(10, $table->getRangerPhysicalSkillPoints(8));
    }

    /**
     * @test
     */
    public function can_give_ranger_psychical_skill_points()
    {
        $table = new BackgroundSkillsTable();

        $this->assertSame(0, $table->getRangerPsychicalSkillPoints(0));
        $this->assertSame(0, $table->getRangerPsychicalSkillPoints(1));
        $this->assertSame(0, $table->getRangerPsychicalSkillPoints(2));
        $this->assertSame(1, $table->getRangerPsychicalSkillPoints(3));
        $this->assertSame(1, $table->getRangerPsychicalSkillPoints(4));
        $this->assertSame(1, $table->getRangerPsychicalSkillPoints(5));
        $this->assertSame(2, $table->getRangerPsychicalSkillPoints(6));
        $this->assertSame(3, $table->getRangerPsychicalSkillPoints(7));
        $this->assertSame(4, $table->getRangerPsychicalSkillPoints(8));
    }

    /**
     * @test
     */
    public function can_give_ranger_combined_skill_points()
    {
        $table = new BackgroundSkillsTable();

        $this->assertSame(1, $table->getRangerCombinedSkillPoints(0));
        $this->assertSame(2, $table->getRangerCombinedSkillPoints(1));
        $this->assertSame(2, $table->getRangerCombinedSkillPoints(2));
        $this->assertSame(3, $table->getRangerCombinedSkillPoints(3));
        $this->assertSame(4, $table->getRangerCombinedSkillPoints(4));
        $this->assertSame(5, $table->getRangerCombinedSkillPoints(5));
        $this->assertSame(6, $table->getRangerCombinedSkillPoints(6));
        $this->assertSame(7, $table->getRangerCombinedSkillPoints(7));
        $this->assertSame(8, $table->getRangerCombinedSkillPoints(8));
    }

    /**
     * @test
     */
    public function can_give_theurgist_physical_skill_points()
    {
        $table = new BackgroundSkillsTable();

        $this->assertSame(0, $table->getTheurgistPhysicalSkillPoints(0));
        $this->assertSame(0, $table->getTheurgistPhysicalSkillPoints(1));
        $this->assertSame(0, $table->getTheurgistPhysicalSkillPoints(2));
        $this->assertSame(1, $table->getTheurgistPhysicalSkillPoints(3));
        $this->assertSame(1, $table->getTheurgistPhysicalSkillPoints(4));
        $this->assertSame(2, $table->getTheurgistPhysicalSkillPoints(5));
        $this->assertSame(2, $table->getTheurgistPhysicalSkillPoints(6));
        $this->assertSame(3, $table->getTheurgistPhysicalSkillPoints(7));
        $this->assertSame(4, $table->getTheurgistPhysicalSkillPoints(8));
    }

    /**
     * @test
     */
    public function can_give_theurgist_psychical_skill_points()
    {
        $table = new BackgroundSkillsTable();

        $this->assertSame(2, $table->getTheurgistPsychicalSkillPoints(0));
        $this->assertSame(3, $table->getTheurgistPsychicalSkillPoints(1));
        $this->assertSame(4, $table->getTheurgistPsychicalSkillPoints(2));
        $this->assertSame(4, $table->getTheurgistPsychicalSkillPoints(3));
        $this->assertSame(5, $table->getTheurgistPsychicalSkillPoints(4));
        $this->assertSame(6, $table->getTheurgistPsychicalSkillPoints(5));
        $this->assertSame(8, $table->getTheurgistPsychicalSkillPoints(6));
        $this->assertSame(10, $table->getTheurgistPsychicalSkillPoints(7));
        $this->assertSame(12, $table->getTheurgistPsychicalSkillPoints(8));
    }

    /**
     * @test
     */
    public function can_give_theurgist_combined_skill_points()
    {
        $table = new BackgroundSkillsTable();

        $this->assertSame(1, $table->getTheurgistCombinedSkillPoints(0));
        $this->assertSame(1, $table->getTheurgistCombinedSkillPoints(1));
        $this->assertSame(1, $table->getTheurgistCombinedSkillPoints(2));
        $this->assertSame(2, $table->getTheurgistCombinedSkillPoints(3));
        $this->assertSame(3, $table->getTheurgistCombinedSkillPoints(4));
        $this->assertSame(3, $table->getTheurgistCombinedSkillPoints(5));
        $this->assertSame(4, $table->getTheurgistCombinedSkillPoints(6));
        $this->assertSame(5, $table->getTheurgistCombinedSkillPoints(7));
        $this->assertSame(6, $table->getTheurgistCombinedSkillPoints(8));
    }
    
    /**
     * @test
     */
    public function can_give_priest_physical_skill_points()
    {
        $table = new BackgroundSkillsTable();

        $this->assertSame(0, $table->getPriestPhysicalSkillPoints(0));
        $this->assertSame(0, $table->getPriestPhysicalSkillPoints(1));
        $this->assertSame(1, $table->getPriestPhysicalSkillPoints(2));
        $this->assertSame(1, $table->getPriestPhysicalSkillPoints(3));
        $this->assertSame(2, $table->getPriestPhysicalSkillPoints(4));
        $this->assertSame(2, $table->getPriestPhysicalSkillPoints(5));
        $this->assertSame(3, $table->getPriestPhysicalSkillPoints(6));
        $this->assertSame(4, $table->getPriestPhysicalSkillPoints(7));
        $this->assertSame(5, $table->getPriestPhysicalSkillPoints(8));
    }

    /**
     * @test
     */
    public function can_give_priest_psychical_skill_points()
    {
        $table = new BackgroundSkillsTable();

        $this->assertSame(1, $table->getPriestPsychicalSkillPoints(0));
        $this->assertSame(2, $table->getPriestPsychicalSkillPoints(1));
        $this->assertSame(2, $table->getPriestPsychicalSkillPoints(2));
        $this->assertSame(3, $table->getPriestPsychicalSkillPoints(3));
        $this->assertSame(3, $table->getPriestPsychicalSkillPoints(4));
        $this->assertSame(4, $table->getPriestPsychicalSkillPoints(5));
        $this->assertSame(5, $table->getPriestPsychicalSkillPoints(6));
        $this->assertSame(7, $table->getPriestPsychicalSkillPoints(7));
        $this->assertSame(9, $table->getPriestPsychicalSkillPoints(8));
    }

    /**
     * @test
     */
    public function can_give_priest_combined_skill_points()
    {
        $table = new BackgroundSkillsTable();

        $this->assertSame(2, $table->getPriestCombinedSkillPoints(0));
        $this->assertSame(2, $table->getPriestCombinedSkillPoints(1));
        $this->assertSame(2, $table->getPriestCombinedSkillPoints(2));
        $this->assertSame(3, $table->getPriestCombinedSkillPoints(3));
        $this->assertSame(4, $table->getPriestCombinedSkillPoints(4));
        $this->assertSame(5, $table->getPriestCombinedSkillPoints(5));
        $this->assertSame(6, $table->getPriestCombinedSkillPoints(6));
        $this->assertSame(7, $table->getPriestCombinedSkillPoints(7));
        $this->assertSame(8, $table->getPriestCombinedSkillPoints(8));
    }
}
