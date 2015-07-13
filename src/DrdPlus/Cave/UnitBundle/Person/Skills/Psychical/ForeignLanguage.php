<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class ForeignLanguage extends AbstractPsychicalSkill
{
    const FOREIGN_LANGUAGE = 'foreign_language';

    /**
     * @return string
     */
    public function getName()
    {
        return self::FOREIGN_LANGUAGE;
    }
}
