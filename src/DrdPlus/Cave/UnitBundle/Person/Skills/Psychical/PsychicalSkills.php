<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\Astronomy;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\Botany;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\EtiquetteOfUnderworld;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\ForeignLanguage;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\GeographyOfACountry;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\HandlingOfMagicalItems;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\Historiography;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\KnowledgeOfACity;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\KnowledgeOfWorld;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\MapsDrawing;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\Mythology;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\ReadingAndWriting;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\SocialEtiquette;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\Technology;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\Theology;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\Zoology;
use Granam\Strict\Object\StrictObject;

/**
 * PsychicalSkills
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class PsychicalSkills extends StrictObject
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

    public function __construct()
    {
        $this->astronomy = new Astronomy();
        $this->botany = new Botany();
        $this->etiquetteOfUnderworld = new EtiquetteOfUnderworld();
        $this->foreignLanguage = new ForeignLanguage();
        $this->geographyOfACountry = new GeographyOfACountry();
        $this->handlingWithMagicalItems = new HandlingOfMagicalItems();
        $this->historiography = new Historiography();
        $this->knowledgeOfACity = new KnowledgeOfACity();
        $this->knowledgeOfWorld = new KnowledgeOfWorld();
        $this->mapsDrawing = new MapsDrawing();
        $this->mythology = new Mythology();
        $this->readingAndWriting = new ReadingAndWriting();
        $this->socialEtiquette = new SocialEtiquette();
        $this->technology = new Technology();
        $this->theology = new Theology();
        $this->zoology = new Zoology();
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
    public function getKnowlegdeOfACity()
    {
        return $this->knowledgeOfACity;
    }

    /**
     * @return KnowledgeOfWorld
     */
    public function getKnowlegdeOfWorld()
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
