<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

use DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkillsGroup;

/**
 * PsychicalSkills
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class PsychicalSkills extends AbstractSkillsGroup
{

    const PSYCHICAL = 'psychical';

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

    /** @var \ArrayIterator */
    private $skillsIterator;

    public function __construct(
        Astronomy $astronomy,
        Botany $botany,
        EtiquetteOfUnderworld $etiquetteOfUnderworld,
        ForeignLanguage $foreignLanguage,
        GeographyOfACountry $geographyOfACountry,
        HandlingOfMagicalItems $handlingWithMagicalItems,
        Historiography $historiography,
        KnowledgeOfACity $knowledgeOfACity,
        KnowledgeOfWorld $knowledgeOfWorld,
        MapsDrawing $mapsDrawing,
        Mythology $mythology,
        ReadingAndWriting $readingAndWriting,
        SocialEtiquette $socialEtiquette,
        Technology $technology,
        Theology $theology,
        Zoology $zoology
    )
    {
        $this->astronomy = $astronomy;
        $this->botany = $botany;
        $this->etiquetteOfUnderworld = $etiquetteOfUnderworld;
        $this->foreignLanguage = $foreignLanguage;
        $this->geographyOfACountry = $geographyOfACountry;
        $this->handlingWithMagicalItems = $handlingWithMagicalItems;
        $this->historiography = $historiography;
        $this->knowledgeOfACity = $knowledgeOfACity;
        $this->knowledgeOfWorld = $knowledgeOfWorld;
        $this->mapsDrawing = $mapsDrawing;
        $this->mythology = $mythology;
        $this->readingAndWriting = $readingAndWriting;
        $this->socialEtiquette = $socialEtiquette;
        $this->technology = $technology;
        $this->theology = $theology;
        $this->zoology = $zoology;

        $this->skillsIterator = $this->createSkillsIterator();
    }

    private function createSkillsIterator()
    {
        return new \ArrayIterator([
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
            $this->getZoology()
        ]);
    }

    /** @return \ArrayIterator */
    protected function getSkillsIterator()
    {
        return $this->skillsIterator;
    }

    /**
     * @return string
     */
    public function getSkillsGroupName()
    {
        return self::PSYCHICAL;
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

}
