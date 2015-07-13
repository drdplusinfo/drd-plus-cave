<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class ClimbingAndHillwalking extends AbstractPhysicalSkill
{
    const CLIMBING_AND_HILLWALKING = 'climbing_and_hillwalking';

    /**
     * @return string
     */
    public function getName()
    {
        return self::CLIMBING_AND_HILLWALKING;
    }
}
