<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

class Seduction extends AbstractCombinedSkill
{
    const SEDUCTION = 'seduction';

    /**
     * @return string
     */
    public function getName()
    {
        return self::SEDUCTION;
    }
}
