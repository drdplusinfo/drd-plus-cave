<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

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

    public function __construct(
        BigHandwork $bigHandwork,
        Cooking $cooking,
        Dancing $dancing,
        DuskSight $duskSight,
        FightWithShootingWeapons $fightWithShootingWeapons,
        FirstAid $firstAid,
        HandingWithAnimals $handingWithAnimals,
        Handwork $handwork,
        Gambling $gambling,
        Herbalism $herbalism,
        HuntingAndFishing $huntingAndFishing,
        Knotting $knotting,
        Painting $painting,
        Pedagogy $pedagogy,
        PlayingOnMusicInstrument $playingOnMusicInstrument,
        Seduction $seduction,
        Showmanship $showmanship,
        Singing $singing,
        Statuary $statuary
    )
    {
        $this->bigHandwork = $bigHandwork;
        $this->cooking = $cooking;
        $this->dancing = $dancing;
        $this->duskSight = $duskSight;
        $this->fightWithShootingWeapons = $fightWithShootingWeapons;
        $this->firstAid = $firstAid;
        $this->handingWithAnimals = $handingWithAnimals;
        $this->handwork = $handwork;
        $this->gambling = $gambling;
        $this->herbalism = $herbalism;
        $this->huntingAndFishing = $huntingAndFishing;
        $this->knotting = $knotting;
        $this->painting = $painting;
        $this->pedagogy = $pedagogy;
        $this->playingOnMusicInstrument = $playingOnMusicInstrument;
        $this->seduction = $seduction;
        $this->showmanship = $showmanship;
        $this->singing = $singing;
        $this->statuary = $statuary;

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
