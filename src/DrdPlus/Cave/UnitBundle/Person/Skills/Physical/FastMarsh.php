<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class FastMarsh extends AbstractPhysicalSkill
{
    const FAST_MARSH = 'fast_marsh';

    /**
     * @return string
     */
    public function getName()
    {
        return self::FAST_MARSH;
    }
}
