<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills;

use DrdPlus\Cave\UnitBundle\Person\Person;
use DrdPlus\Cave\UnitBundle\Person\Skills\Combined\CombinedSkills;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\PsychicalSkills;
use DrdPlus\Cave\UnitBundle\Person\Skills\Physical\PhysicalSkills;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

class SkillsTest extends TestWithMockery
{

    /**
     * @test
     *
     * @return Skills
     */
    public function can_create_instance()
    {
        $instance = new Skills(
            $person = $this->mockery(Person::class),
            $physicalSKills = $this->mockery(PhysicalSkills::class),
            $psychicalSkills = $this->mockery(PsychicalSkills::class),
            $combinedSkills = $this->mockery(CombinedSkills::class)
        );
        $this->assertNotNull($instance);
        $this->assertSame($person, $instance->getPerson());
        $this->assertSame($physicalSKills, $instance->getPhysicalSkills());
        $this->assertSame($psychicalSkills, $instance->getPsychicalSkills());
        $this->assertSame($combinedSkills, $instance->getCombinedSkills());

        return $instance;
    }

}
