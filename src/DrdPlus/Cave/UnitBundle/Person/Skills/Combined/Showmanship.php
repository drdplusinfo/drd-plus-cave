<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

class Showmanship extends AbstractCombinedSkill
{
    const SHOWMANSHIP = 'showmanship';

    /**
     * @return string
     */
    public function getName()
    {
        return self::SHOWMANSHIP;
    }
}
