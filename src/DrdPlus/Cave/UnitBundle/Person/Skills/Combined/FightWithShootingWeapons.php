<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

class FightWithShootingWeapons extends AbstractCombinedSkill
{
    const FIGHT_WITH_SHOOTING_WEAPONS = 'fight_with_shooting_weapons';

    /**
     * @return string
     */
    public function getName()
    {
        return self::FIGHT_WITH_SHOOTING_WEAPONS;
    }

}
