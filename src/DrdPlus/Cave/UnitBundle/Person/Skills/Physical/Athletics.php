<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Athletics extends AbstractPhysicalSkill
{
    const ATHLETICS = 'athletics';

    /**
     * @return string
     */
    public function getName()
    {
        return self::ATHLETICS;
    }

}
