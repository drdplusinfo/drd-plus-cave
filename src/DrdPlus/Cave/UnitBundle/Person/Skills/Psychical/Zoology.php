<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Zoology extends AbstractPsychicalSkill
{
    const ZOOLOGY = 'zoology';

    /**
     * @return string
     */
    public function getName()
    {
        return self::ZOOLOGY;
    }
}
