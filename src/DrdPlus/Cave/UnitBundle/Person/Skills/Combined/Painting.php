<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

class Painting extends AbstractCombinedSkill
{
    const PAINTING = 'painting';

    /**
     * @return string
     */
    public function getName()
    {
        return self::PAINTING;
    }
}
