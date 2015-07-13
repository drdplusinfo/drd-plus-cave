<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

class DuskSight extends AbstractCombinedSkill
{
    const DUSK_SIGHT = 'dusk_sight';

    /**
     * @return string
     */
    public function getName()
    {
        return self::DUSK_SIGHT;
    }
}
