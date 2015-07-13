<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class FightWithWeapon extends AbstractPhysicalSkill
{
    const FIGHT_WITH_WEAPON = 'fight_with_weapon';

    /**
     * @return string
     */
    public function getName()
    {
        return self::FIGHT_WITH_WEAPON;
    }
}
