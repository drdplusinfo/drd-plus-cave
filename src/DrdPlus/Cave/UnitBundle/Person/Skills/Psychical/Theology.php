<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Theology extends AbstractPsychicalSkill
{
    const THEOLOGY = 'theology';

    /**
     * @return string
     */
    public function getName()
    {
        return self::THEOLOGY;
    }
}
