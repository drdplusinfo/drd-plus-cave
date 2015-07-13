<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Blacksmithing extends AbstractPhysicalSkill
{
    const BLACKSMITHING = 'blacksmithing';

    /**
     * @return string
     */
    public function getName()
    {
        return self::BLACKSMITHING;
    }
}
