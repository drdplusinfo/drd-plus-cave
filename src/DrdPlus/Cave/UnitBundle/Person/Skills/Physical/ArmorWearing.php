<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class ArmorWearing extends AbstractPhysicalSkill
{
    const ARMOR_WEARING = 'armor_wearing';

    /**
     * @return string
     */
    public function getName()
    {
        return self::ARMOR_WEARING;
    }
}
