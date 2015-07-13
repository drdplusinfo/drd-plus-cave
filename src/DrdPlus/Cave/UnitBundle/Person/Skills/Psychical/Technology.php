<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Technology extends AbstractPsychicalSkill
{
    const TECHNOLOGY = 'technology';

    /**
     * @return string
     */
    public function getName()
    {
        return self::TECHNOLOGY;
    }
}
