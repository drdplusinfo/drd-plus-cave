<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

class Pedagogy extends AbstractCombinedSkill
{
    const PEDAGOGY = 'pedagogy';

    /**
     * @return string
     */
    public function getName()
    {
        return self::PEDAGOGY;
    }

}
