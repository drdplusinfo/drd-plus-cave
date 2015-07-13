<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class ReadingAndWriting extends AbstractPsychicalSkill
{
    const READING_WRITING = 'reading_writing';

    /**
     * @return string
     */
    public function getName()
    {
        return self::READING_WRITING;
    }
}
