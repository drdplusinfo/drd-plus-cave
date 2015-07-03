<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkill;

/**
 * @ORM\Entity()
 * @ORM\Table()
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *  "astronomy" = "Astronomy,
 *  "botany" = "Botany,
 *  "etiquetteOfUnderworld" = "EtiquetteOfUnderworld,
 *  "foreignLanguage" = "ForeignLanguage,
 *  "geographyOfACountry" = "GeographyOfACountry,
 *  "handlingOfMagicalItems" = "HandlingOfMagicalItems,
 *  "historiography" = "Historiography,
 *  "knowledgeOfACity" = "KnowledgeOfACity,
 *  "knowledgeOfWorld" = "KnowledgeOfWorld,
 *  "mapsDrawing" = "MapsDrawing,
 *  "mythology" = "Mythology,
 *  "readingAndWriting" = "ReadingAndWriting,
 *  "socialEtiquette" = "SocialEtiquette,
 *  "technology" = "Technology,
 *  "theology" = "Theology,
 *  "zoology" = "Zoology
 * })
 */
abstract class AbstractPsychicalSkill extends AbstractSkill
{
    /**
     * @return string[]
     */
    public function getRelatedProperties()
    {
        return [Intelligence::INTELLIGENCE, Will::WILL];
    }

    /**
     * @return bool
     */
    public function isPhysical()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isPsychical()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isCombined()
    {
        return false;
    }
}
