<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class KnowledgeOfACity extends AbstractPsychicalSkill
{
    const KNOWLEDGE_OF_A_CITY = 'knowledge_of_a_city';

    /**
     * @return string
     */
    public function getName()
    {
        return self::KNOWLEDGE_OF_A_CITY;
    }
}
