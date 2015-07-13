<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class MovingInMountains extends AbstractPhysicalSkill
{
    const MOVING_IN_MOUNTAINS = 'moving_in_mountains';

    /**
     * @return string
     */
    public function getName()
    {
        return self::MOVING_IN_MOUNTAINS;
    }
}
