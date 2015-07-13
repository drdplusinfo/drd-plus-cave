<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

class Singing extends AbstractCombinedSkill
{
    const SINGING = 'singing';

    /**
     * @return string
     */
    public function getName()
    {
        return self::SINGING;
    }
}
