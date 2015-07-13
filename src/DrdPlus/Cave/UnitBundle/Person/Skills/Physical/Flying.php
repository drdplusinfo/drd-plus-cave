<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Flying extends AbstractPhysicalSkill
{
    const FLYING = 'flying';

    /**
     * @return string
     */
    public function getName()
    {
        return self::FLYING;
    }
}
