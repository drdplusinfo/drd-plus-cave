<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

class FirstAid extends AbstractCombinedSkill
{
    const FIRST_AID = 'first_aid';

    /**
     * @return string
     */
    public function getName()
    {
        return self::FIRST_AID;
    }
}
