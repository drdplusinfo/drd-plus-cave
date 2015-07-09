<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills;

use DrdPlus\Cave\UnitBundle\Person\Skills\Combined\CombinedSkills;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\PsychicalSkills;
use DrdPlus\Cave\UnitBundle\Person\Skills\Physical\PhysicalSkills;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

class SkillsTest extends TestWithMockery
{

    /**
     * @test
     */
    public function can_create_instance()
    {
        /** @var PhysicalSkills $physicalSKills */
        $physicalSKills = $this->mockery(PhysicalSkills::class);
        /** @var PsychicalSkills $psychicalSkills */
        $psychicalSkills = $this->mockery(PsychicalSkills::class);
        /** @var CombinedSkills $combinedSkills */
        $combinedSkills = $this->mockery(CombinedSkills::class);

        $instance = new Skills($physicalSKills, $psychicalSkills, $combinedSkills);

        $this->assertNotNull($instance);
        $this->assertSame($physicalSKills, $instance->getPhysicalSkills());
        $this->assertSame($psychicalSkills, $instance->getPsychicalSkills());
        $this->assertSame($combinedSkills, $instance->getCombinedSkills());
    }

}
