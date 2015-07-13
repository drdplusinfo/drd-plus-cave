<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

class HandingWithAnimals extends AbstractCombinedSkill
{
    const HANDING_WITH_ANIMALS = 'handing_with_animals';

    /**
     * @return string
     */
    public function getName()
    {
        return self::HANDING_WITH_ANIMALS;
    }
}
