<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Historiography extends AbstractPsychicalSkill
{
    const HISTORIOGRAPHY = 'historiography';

    /**
     * @return string
     */
    public function getName()
    {
        return self::HISTORIOGRAPHY;
    }
}
