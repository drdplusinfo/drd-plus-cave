<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkillsGroup;

/**
 * CombinedSkills
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class CombinedSkills extends AbstractSkillsGroup
{
    const COMBINED = 'combined';

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /** @var BigHandwork */
    private $bigHandwork;
    /** @var Cooking */
    private $cooking;
    /** @var Dancing */
    private $dancing;
    /** @var DuskSight */
    private $duskSight;
    /** @var FightWithShootingWeapons */
    private $fightWithShootingWeapons;
    /** @var FirstAid */
    private $firstAid;
    /** @var HandingWithAnimals */
    private $handingWithAnimals;
    /** @var Handwork */
    private $handwork;
    /** @var Gambling */
    private $gambling;
    /** @var Herbalism */
    private $herbalism;
    /** @var HuntingAndFishing */
    private $huntingAndFishing;
    /** @var Knotting */
    private $knotting;
    /** @var Painting */
    private $painting;
    /** @var Pedagogy */
    private $pedagogy;
    /** @var PlayingOnMusicInstrument */
    private $playingOnMusicInstrument;
    /** @var Seduction */
    private $seduction;
    /** @var Showmanship */
    private $showmanship;
    /** @var Singing */
    private $singing;
    /** @var Statuary */
    private $statuary;

    /** @var \ArrayIterator */
    private $skillsIterator;

    public function __construct(ProfessionLevel $professionLevel)
    {
        $this->bigHandwork = new BigHandwork($this->createZeroSkillRank($professionLevel));
        $this->cooking = new Cooking($this->createZeroSkillRank($professionLevel));
        $this->dancing = new Dancing($this->createZeroSkillRank($professionLevel));
        $this->duskSight = new DuskSight($this->createZeroSkillRank($professionLevel));
        $this->fightWithShootingWeapons = new FightWithShootingWeapons($this->createZeroSkillRank($professionLevel));
        $this->firstAid = new FirstAid($this->createZeroSkillRank($professionLevel));
        $this->handingWithAnimals = new HandingWithAnimals($this->createZeroSkillRank($professionLevel));
        $this->handwork = new Handwork($this->createZeroSkillRank($professionLevel));
        $this->gambling = new Gambling($this->createZeroSkillRank($professionLevel));
        $this->herbalism = new Herbalism($this->createZeroSkillRank($professionLevel));
        $this->huntingAndFishing = new HuntingAndFishing($this->createZeroSkillRank($professionLevel));
        $this->knotting = new Knotting($this->createZeroSkillRank($professionLevel));
        $this->painting = new Painting($this->createZeroSkillRank($professionLevel));
        $this->pedagogy = new Pedagogy($this->createZeroSkillRank($professionLevel));
        $this->playingOnMusicInstrument = new PlayingOnMusicInstrument($this->createZeroSkillRank($professionLevel));
        $this->seduction = new Seduction($this->createZeroSkillRank($professionLevel));
        $this->showmanship = new Showmanship($this->createZeroSkillRank($professionLevel));
        $this->singing = new Singing($this->createZeroSkillRank($professionLevel));
        $this->statuary = new Statuary($this->createZeroSkillRank($professionLevel));

        $this->skillsIterator = $this->createSkillsIterator();
    }

    private function createSkillsIterator()
    {
        return new \ArrayIterator([
            $this->getBigHandwork(),
            $this->getCooking(),
            $this->getDancing(),
            $this->getDuskSight(),
            $this->getFightWithShootingWeapons(),
            $this->getFirstAid(),
            $this->getGambling(),
            $this->getHandingWithAnimals(),
            $this->getHandwork(),
            $this->getHerbalism(),
            $this->getHuntingAndFishing(),
            $this->getKnotting(),
            $this->getPainting(),
            $this->getPedagogy(),
            $this->getPlayingOnMusicInstrument(),
            $this->getSeduction(),
            $this->getShowmanship(),
            $this->getSinging(),
            $this->getStatuary()
        ]);
    }

    /**
     * @return \ArrayIterator
     */
    protected function getSkillsIterator()
    {
        return $this->skillsIterator;
    }

    /**
     * @return string
     */
    public function getSkillsGroupName()
    {
        return self::COMBINED;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return BigHandwork
     */
    public function getBigHandwork()
    {
        return $this->bigHandwork;
    }

    /**
     * @return Cooking
     */
    public function getCooking()
    {
        return $this->cooking;
    }

    /**
     * @return Dancing
     */
    public function getDancing()
    {
        return $this->dancing;
    }

    /**
     * @return DuskSight
     */
    public function getDuskSight()
    {
        return $this->duskSight;
    }

    /**
     * @return FightWithShootingWeapons
     */
    public function getFightWithShootingWeapons()
    {
        return $this->fightWithShootingWeapons;
    }

    /**
     * @return FirstAid
     */
    public function getFirstAid()
    {
        return $this->firstAid;
    }

    /**
     * @return HandingWithAnimals
     */
    public function getHandingWithAnimals()
    {
        return $this->handingWithAnimals;
    }

    /**
     * @return Handwork
     */
    public function getHandwork()
    {
        return $this->handwork;
    }

    /**
     * @return Gambling
     */
    public function getGambling()
    {
        return $this->gambling;
    }

    /**
     * @return Herbalism
     */
    public function getHerbalism()
    {
        return $this->herbalism;
    }

    /**
     * @return HuntingAndFishing
     */
    public function getHuntingAndFishing()
    {
        return $this->huntingAndFishing;
    }

    /**
     * @return Knotting
     */
    public function getKnotting()
    {
        return $this->knotting;
    }

    /**
     * @return Painting
     */
    public function getPainting()
    {
        return $this->painting;
    }

    /**
     * @return Pedagogy
     */
    public function getPedagogy()
    {
        return $this->pedagogy;
    }

    /**
     * @return PlayingOnMusicInstrument
     */
    public function getPlayingOnMusicInstrument()
    {
        return $this->playingOnMusicInstrument;
    }

    /**
     * @return Seduction
     */
    public function getSeduction()
    {
        return $this->seduction;
    }

    /**
     * @return Showmanship
     */
    public function getShowmanship()
    {
        return $this->showmanship;
    }

    /**
     * @return Singing
     */
    public function getSinging()
    {
        return $this->singing;
    }

    /**
     * @return Statuary
     */
    public function getStatuary()
    {
        return $this->statuary;
    }

}
