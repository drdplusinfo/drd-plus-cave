<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Botany extends AbstractPsychicalSkill
{
    const BOTANY = 'botany';

    /**
     * @return string
     */
    public function getName()
    {
        return self::BOTANY;
    }
}
