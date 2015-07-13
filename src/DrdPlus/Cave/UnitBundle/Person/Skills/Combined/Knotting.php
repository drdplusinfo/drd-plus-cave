<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

class Knotting extends AbstractCombinedSkill
{
    const KNOTTING = 'knotting';

    /**
     * @return string
     */
    public function getName()
    {
        return self::KNOTTING;
    }
}
