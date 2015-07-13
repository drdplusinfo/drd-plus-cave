<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Riding extends AbstractPhysicalSkill
{
    const RIDING = 'riding';

    /**
     * @return string
     */
    public function getName()
    {
        return self::RIDING;
    }
}
