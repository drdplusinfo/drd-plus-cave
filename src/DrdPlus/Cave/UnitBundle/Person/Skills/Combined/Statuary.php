<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

class Statuary extends AbstractCombinedSkill
{
    const STATUARY = 'statuary';

    /**
     * @return string
     */
    public function getName()
    {
        return self::STATUARY;
    }
}
