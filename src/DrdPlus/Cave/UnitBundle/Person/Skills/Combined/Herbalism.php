<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

class Herbalism extends AbstractCombinedSkill
{
    const HERBALISM = 'herbalism';

    /**
     * @return string
     */
    public function getName()
    {
        return self::HERBALISM;
    }
}
