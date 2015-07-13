<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

class BigHandwork extends AbstractCombinedSkill
{
    const BIG_HANDWORK = 'big_handwork';

    /**
     * @return string
     */
    public function getName()
    {
        return self::BIG_HANDWORK;
    }

}
