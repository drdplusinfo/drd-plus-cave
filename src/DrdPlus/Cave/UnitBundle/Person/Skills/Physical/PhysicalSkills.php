<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkillsGroup;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\AbstractPsychicalSkill;

/**
 * PhysicalSkills
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class PhysicalSkills extends AbstractSkillsGroup
{

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @var ArmorWearing */
    private $armorWearing;
    /** @var Athletics */
    private $athletics;
    /** @var Blacksmithing */
    private $blacksmithing;
    /** @var BoatDriving */
    private $boatDriving;
    /** @var CartDriving */
    private $cartDriving;
    /** @var CityMoving */
    private $cityMoving;
    /** @var ClimbingAndHillwalking */
    private $climbingAndHillwalking;
    /** @var FastMarsh */
    private $fastMarsh;
    /** @var FightWithWeapon */
    private $fightWithWeapon;
    /** @var Flying */
    private $flying;
    /** @var ForestMoving */
    private $forestMoving;
    /** @var MovingInMountain */
    private $movingInMountain;
    /** @var Riding */
    private $riding;
    /** @var Sailing */
    private $sailing;
    /** @var ShieldUsage */
    private $shieldUsage;
    /** @var Swimming */
    private $swimming;

    public function __construct(ProfessionLevel $professionLevel)
    {
        $this->armorWearing = new ArmorWearing($this->createZeroSkillRank($professionLevel));
        $this->athletics = new Athletics($this->createZeroSkillRank($professionLevel));
        $this->blacksmithing = new Blacksmithing($this->createZeroSkillRank($professionLevel));
        $this->boatDriving = new BoatDriving($this->createZeroSkillRank($professionLevel));
        $this->cartDriving = new CartDriving($this->createZeroSkillRank($professionLevel));
        $this->cityMoving = new CityMoving($this->createZeroSkillRank($professionLevel));
        $this->climbingAndHillwalking = new ClimbingAndHillwalking($this->createZeroSkillRank($professionLevel));
        $this->fastMarsh = new FastMarsh($this->createZeroSkillRank($professionLevel));
        $this->fightWithWeapon = new FightWithWeapon($this->createZeroSkillRank($professionLevel));
        $this->flying = new Flying($this->createZeroSkillRank($professionLevel));
        $this->forestMoving = new ForestMoving($this->createZeroSkillRank($professionLevel));
        $this->movingInMountain = new MovingInMountain($this->createZeroSkillRank($professionLevel));
        $this->riding = new Riding($this->createZeroSkillRank($professionLevel));
        $this->sailing = new Sailing($this->createZeroSkillRank($professionLevel));
        $this->shieldUsage = new ShieldUsage($this->createZeroSkillRank($professionLevel));
        $this->swimming = new Swimming($this->createZeroSkillRank($professionLevel));
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ArmorWearing
     */
    public function getArmorWearing()
    {
        return $this->armorWearing;
    }

    /**
     * @return Athletics
     */
    public function getAthletics()
    {
        return $this->athletics;
    }

    /**
     * @return Blacksmithing
     */
    public function getBlacksmithing()
    {
        return $this->blacksmithing;
    }

    /**
     * @return BoatDriving
     */
    public function getBoatDriving()
    {
        return $this->boatDriving;
    }

    /**
     * @return CartDriving
     */
    public function getCartDriving()
    {
        return $this->cartDriving;
    }

    /**
     * @return CityMoving
     */
    public function getCityMoving()
    {
        return $this->cityMoving;
    }

    /**
     * @return ClimbingAndHillwalking
     */
    public function getClimbingAndHillwalking()
    {
        return $this->climbingAndHillwalking;
    }

    /**
     * @return FastMarsh
     */
    public function getFastMarsh()
    {
        return $this->fastMarsh;
    }

    /**
     * @return FightWithWeapon
     */
    public function getFightWithWeapon()
    {
        return $this->fightWithWeapon;
    }

    /**
     * @return Flying
     */
    public function getFlying()
    {
        return $this->flying;
    }

    /**
     * @return ForestMoving
     */
    public function getForestMoving()
    {
        return $this->forestMoving;
    }

    /**
     * @return MovingInMountain
     */
    public function getMovingInMountains()
    {
        return $this->movingInMountain;
    }

    /**
     * @return Riding
     */
    public function getRiding()
    {
        return $this->riding;
    }

    /**
     * @return Sailing
     */
    public function getSailing()
    {
        return $this->sailing;
    }

    /**
     * @return ShieldUsage
     */
    public function getShieldUsage()
    {
        return $this->shieldUsage;
    }

    /**
     * @return Swimming
     */
    public function getSwimming()
    {
        return $this->swimming;
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
                    $this->getArmorWearing(),
                    $this->getAthletics(),
                    $this->getBlacksmithing(),
                    $this->getBoatDriving(),
                    $this->getCartDriving(),
                    $this->getCityMoving(),
                    $this->getClimbingAndHillwalking(),
                    $this->getFastMarsh(),
                    $this->getFightWithWeapon(),
                    $this->getFlying(),
                    $this->getForestMoving(),
                    $this->getMovingInMountains(),
                    $this->getRiding(),
                    $this->getSailing(),
                    $this->getShieldUsage(),
                    $this->getSwimming(),
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
