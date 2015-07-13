<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

class Gambling extends AbstractCombinedSkill
{
    const GAMBLING = 'gambling';

    /**
     * @return string
     */
    public function getName()
    {
        return self::GAMBLING;
    }
}
