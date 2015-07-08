<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkillsGroup;

/**
 * PsychicalSkills
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class PsychicalSkills extends AbstractSkillsGroup
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @var Astronomy */
    private $astronomy;
    /** @var Botany */
    private $botany;
    /** @var EtiquetteOfUnderworld */
    private $etiquetteOfUnderworld;
    /** @var ForeignLanguage */
    private $foreignLanguage;
    /** @var GeographyOfACountry */
    private $geographyOfACountry;
    /** @var HandlingOfMagicalItems */
    private $handlingWithMagicalItems;
    /** @var Historiography */
    private $historiography;
    /** @var KnowledgeOfACity */
    private $knowledgeOfACity;
    /** @var KnowledgeOfWorld */
    private $knowledgeOfWorld;
    /** @var MapsDrawing */
    private $mapsDrawing;
    /** @var Mythology */
    private $mythology;
    /** @var ReadingAndWriting */
    private $readingAndWriting;
    /** @var SocialEtiquette */
    private $socialEtiquette;
    /** @var Technology */
    private $technology;
    /** @var Theology */
    private $theology;
    /** @var Zoology */
    private $zoology;

    public function __construct(ProfessionLevel $professionLevel)
    {
        $this->astronomy = new Astronomy($this->createZeroSkillRank($professionLevel));
        $this->botany = new Botany($this->createZeroSkillRank($professionLevel));
        $this->etiquetteOfUnderworld = new EtiquetteOfUnderworld($this->createZeroSkillRank($professionLevel));
        $this->foreignLanguage = new ForeignLanguage($this->createZeroSkillRank($professionLevel));
        $this->geographyOfACountry = new GeographyOfACountry($this->createZeroSkillRank($professionLevel));
        $this->handlingWithMagicalItems = new HandlingOfMagicalItems($this->createZeroSkillRank($professionLevel));
        $this->historiography = new Historiography($this->createZeroSkillRank($professionLevel));
        $this->knowledgeOfACity = new KnowledgeOfACity($this->createZeroSkillRank($professionLevel));
        $this->knowledgeOfWorld = new KnowledgeOfWorld($this->createZeroSkillRank($professionLevel));
        $this->mapsDrawing = new MapsDrawing($this->createZeroSkillRank($professionLevel));
        $this->mythology = new Mythology($this->createZeroSkillRank($professionLevel));
        $this->readingAndWriting = new ReadingAndWriting($this->createZeroSkillRank($professionLevel));
        $this->socialEtiquette = new SocialEtiquette($this->createZeroSkillRank($professionLevel));
        $this->technology = new Technology($this->createZeroSkillRank($professionLevel));
        $this->theology = new Theology($this->createZeroSkillRank($professionLevel));
        $this->zoology = new Zoology($this->createZeroSkillRank($professionLevel));
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Astronomy
     */
    public function getAstronomy()
    {
        return $this->astronomy;
    }

    /**
     * @return Botany
     */
    public function getBotany()
    {
        return $this->botany;
    }

    /**
     * @return EtiquetteOfUnderworld
     */
    public function getEtiquetteOfUnderworld()
    {
        return $this->etiquetteOfUnderworld;
    }

    /**
     * @return ForeignLanguage
     */
    public function getForeignLanguage()
    {
        return $this->foreignLanguage;
    }

    /**
     * @return GeographyOfACountry
     */
    public function getGeographyOfACountry()
    {
        return $this->geographyOfACountry;
    }

    /**
     * @return HandlingOfMagicalItems
     */
    public function getHandlingWithMagicalItems()
    {
        return $this->handlingWithMagicalItems;
    }

    /**
     * @return Historiography
     */
    public function getHistoriography()
    {
        return $this->historiography;
    }

    /**
     * @return KnowledgeOfACity
     */
    public function getKnowledgeOfACity()
    {
        return $this->knowledgeOfACity;
    }

    /**
     * @return KnowledgeOfWorld
     */
    public function getKnowledgeOfWorld()
    {
        return $this->knowledgeOfWorld;
    }

    /**
     * @return MapsDrawing
     */
    public function getMapsDrawing()
    {
        return $this->mapsDrawing;
    }

    /**
     * @return Mythology
     */
    public function getMythology()
    {
        return $this->mythology;
    }

    /**
     * @return ReadingAndWriting
     */
    public function getReadingAndWriting()
    {
        return $this->readingAndWriting;
    }

    /**
     * @return SocialEtiquette
     */
    public function getSocialEtiquette()
    {
        return $this->socialEtiquette;
    }

    /**
     * @return Technology
     */
    public function getTechnology()
    {
        return $this->technology;
    }

    /**
     * @return Theology
     */
    public function getTheology()
    {
        return $this->theology;
    }

    /**
     * @return Zoology
     */
    public function getZoology()
    {
        return $this->zoology;
    }

    /**
     * @return int
     */
    public function getNextLevelsSkillRankSummary()
    {
        // TODO next levels only
        return (int)array_sum(
            array_map(
                function (AbstractPsychicalSkill $skill) {
                    return $skill->getSkillRanks()->getValue();
                },
                [
                    $this->getAstronomy(),
                    $this->getBotany(),
                    $this->getEtiquetteOfUnderworld(),
                    $this->getForeignLanguage(),
                    $this->getGeographyOfACountry(),
                    $this->getHandlingWithMagicalItems(),
                    $this->getHistoriography(),
                    $this->getKnowledgeOfACity(),
                    $this->getKnowledgeOfWorld(),
                    $this->getMapsDrawing(),
                    $this->getMythology(),
                    $this->getReadingAndWriting(),
                    $this->getSocialEtiquette(),
                    $this->getTechnology(),
                    $this->getTheology(),
                    $this->getZoology(),
                ]
            )
        );
    }

    /**
     * @return int
     */
    public function getFirstLevelsSkillRankSummary()
    {
        // TODO: Implement getFirstLevelsSkillRankSummary() method.
    }

}
