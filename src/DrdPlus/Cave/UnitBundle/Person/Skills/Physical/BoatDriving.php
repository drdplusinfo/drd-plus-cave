<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class BoatDriving extends AbstractPhysicalSkill
{
    const BOAT_DRIVING = 'boat_driving';

    /**
     * @return string
     */
    public function getName()
    {
        return self::BOAT_DRIVING;
    }
}
