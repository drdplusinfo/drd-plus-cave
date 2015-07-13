<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Swimming extends AbstractPhysicalSkill
{
    const SWIMMING = 'swimming';

    /**
     * @return string
     */
    public function getName()
    {
        return self::SWIMMING;
    }
}
