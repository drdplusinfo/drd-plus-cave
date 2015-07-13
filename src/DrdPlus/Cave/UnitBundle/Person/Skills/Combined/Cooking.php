<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

class Cooking extends AbstractCombinedSkill
{
    const COOKING = 'cooking';

    /**
     * @return string
     */
    public function getName()
    {
        return self::COOKING;
    }

}
