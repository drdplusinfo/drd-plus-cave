<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Astronomy extends AbstractPsychicalSkill
{
    const ASTRONOMY = 'astronomy';

    /**
     * @return string
     */
    public function getName()
    {
        return self::ASTRONOMY;
    }
}
