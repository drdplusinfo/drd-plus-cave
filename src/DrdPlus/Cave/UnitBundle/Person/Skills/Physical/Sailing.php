<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Sailing extends AbstractPhysicalSkill
{
    const SAILING = 'sailing';

    /**
     * @return string
     */
    public function getName()
    {
        return self::SAILING;
    }
}
