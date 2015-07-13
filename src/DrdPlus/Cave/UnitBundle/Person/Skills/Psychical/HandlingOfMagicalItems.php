<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class HandlingOfMagicalItems extends AbstractPsychicalSkill
{
    const HANDING_OF_MAGICAL_ITEMS = 'handing_of_magical_items';

    /**
     * @return string
     */
    public function getName()
    {
        return self::HANDING_OF_MAGICAL_ITEMS;
    }
}
