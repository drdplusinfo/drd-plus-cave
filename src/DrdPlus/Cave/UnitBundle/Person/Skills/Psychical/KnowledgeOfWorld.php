<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class KnowledgeOfWorld extends AbstractPsychicalSkill
{
    const KNOWLEDGE_OF_WORLD = 'knowledge_of_world';

    /**
     * @return string
     */
    public function getName()
    {
        return self::KNOWLEDGE_OF_WORLD;
    }
}
