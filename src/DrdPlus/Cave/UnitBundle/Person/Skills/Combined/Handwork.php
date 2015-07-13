<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

class Handwork extends AbstractCombinedSkill
{
    const HANDWORK = 'handwork';

    /**
     * @return string
     */
    public function getName()
    {
        return self::HANDWORK;
    }

}
