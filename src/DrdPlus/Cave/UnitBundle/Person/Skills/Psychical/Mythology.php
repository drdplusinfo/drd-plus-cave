<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Mythology extends AbstractPsychicalSkill
{
    const MYTHOLOGY = 'mythology';

    /**
     * @return string
     */
    public function getName()
    {
        return self::MYTHOLOGY;
    }
}
