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

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var Cooking
     */
    private $cooking;
    /**
     * @var Dancing
     */
    private $dancing;
    /**
     * @var DuskSight
     */
    private $duskSight;
    /**
     * @var FightWithShootingWeapons
     */
    private $fightWithShootingWeapons;
    /**
     * @var FirstAid
     */
    private $firstAid;
    /**
     * @var HandingWithAnimals
     */
    private $handingWithAnimals;
    /**
     * @var Handwork
     */
    private $handwork;
    /**
     * @var Gambling
     */
    private $gambling;
    /**
     * @var Herbalism
     */
    private $herbalism;
    /**
     * @var HuntingAndFishing
     */
    private $huntingAndFishing;
    /**
     * @var Knotting
     */
    private $knotting;
    /**
     * @var Painting
     */
    private $painting;
    /**
     * @var Pedagogy
     */
    private $pedagogy;
    /**
     * @var PlayingOnMusicInstrument
     */
    private $playingOnMusicInstrument;
    /**
     * @var Seduction
     */
    private $seduction;
    /**
     * @var Showmanship
     */
    private $showmanship;
    /**
     * @var Singing
     */
    private $singing;
    /**
     * @var Statuary
     */
    private $statuary;

    public function __construct()
    {
        $this->bigHandwork = new BigHandwork();
        $this->cooking = new Cooking();
        $this->dancing = new Dancing();
        $this->duskSight = new DuskSight();
        $this->fightWithShootingWeapons = new FightWithShootingWeapons();
        $this->firstAid = new FirstAid();
        $this->handingWithAnimals = new HandingWithAnimals();
        $this->handwork = new Handwork();
        $this->gambling = new Gambling();
        $this->herbalism = new Herbalism();
        $this->huntingAndFishing = new HuntingAndFishing();
        $this->knotting = new Knotting();
        $this->painting = new Painting();
        $this->pedagogy = new Pedagogy();
        $this->playingOnMusicInstrument = new PlayingOnMusicInstrument();
        $this->seduction = new Seduction();
        $this->showmanship = new Showmanship();
        $this->singing = new Singing();
        $this->statuary = new Statuary();
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

    /**
     * @return int
     */
    public function getNextLevelsSkillRankSummary()
    {
        // TODO next levels only
        return (int)array_sum(
            array_map(
                function (AbstractCombinedSkill $skill) {
                    return $skill->getSkillRank()->getValue();
                },
                [
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
                    $this->getStatuary(),
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
