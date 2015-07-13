<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

class Dancing extends AbstractCombinedSkill
{
    const DANCING = 'dancing';

    /**
     * @return string
     */
    public function getName()
    {
        return self::DANCING;
    }
}
