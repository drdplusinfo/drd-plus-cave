<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class ShieldUsage extends AbstractPhysicalSkill
{
    const SHIELD_USAGE = 'shield_usage';

    /**
     * @return string
     */
    public function getName()
    {
        return self::SHIELD_USAGE;
    }
}
