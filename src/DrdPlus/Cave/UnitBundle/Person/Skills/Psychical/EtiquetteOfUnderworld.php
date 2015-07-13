<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class EtiquetteOfUnderworld extends AbstractPsychicalSkill
{
    const ETIQUETTE_OF_UNDERWORLD = 'etiquette_of_underworld';

    /**
     * @return string
     */
    public function getName()
    {
        return self::ETIQUETTE_OF_UNDERWORLD;
    }
}
