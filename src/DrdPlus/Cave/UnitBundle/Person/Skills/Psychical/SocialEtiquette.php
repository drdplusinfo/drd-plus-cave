<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class SocialEtiquette extends AbstractPsychicalSkill
{
    const SOCIAL_ETIQUETTE = 'social_etiquette';

    /**
     * @return string
     */
    public function getName()
    {
        return self::SOCIAL_ETIQUETTE;
    }
}
