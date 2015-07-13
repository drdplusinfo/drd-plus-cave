<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class CityMoving extends AbstractPhysicalSkill
{
    const CITY_MOVING = 'city_moving';

    /**
     * @return string
     */
    public function getName()
    {
        return self::CITY_MOVING;
    }
}
