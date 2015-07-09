<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

use DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkillsGroup;

/**
 * PhysicalSkills
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class PhysicalSkills extends AbstractSkillsGroup
{
    const PHYSICAL = 'physical';

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

    /** @var \ArrayIterator */
    private $skillsIterator;

    public function __construct(
        ArmorWearing $armorWearing,
        Athletics $athletics,
        Blacksmithing $blacksmithing,
        BoatDriving $boatDriving,
        CartDriving $cartDriving,
        CityMoving $cityMoving,
        ClimbingAndHillwalking $climbingAndHillwalking,
        FastMarsh $fastMarsh,
        FightWithWeapon $fightWithWeapon,
        Flying $flying,
        ForestMoving $forestMoving,
        MovingInMountain $movingInMountain,
        Riding $riding,
        Sailing $sailing,
        ShieldUsage $shieldUsage,
        Swimming $swimming
    )
    {
        $this->armorWearing = $armorWearing;
        $this->athletics = $athletics;
        $this->blacksmithing = $blacksmithing;
        $this->boatDriving = $boatDriving;
        $this->cartDriving = $cartDriving;
        $this->cityMoving = $cityMoving;
        $this->climbingAndHillwalking = $climbingAndHillwalking;
        $this->fastMarsh = $fastMarsh;
        $this->fightWithWeapon = $fightWithWeapon;
        $this->flying = $flying;
        $this->forestMoving = $forestMoving;
        $this->movingInMountain = $movingInMountain;
        $this->riding = $riding;
        $this->sailing = $sailing;
        $this->shieldUsage = $shieldUsage;
        $this->swimming = $swimming;

        $this->skillsIterator = $this->createSkillsIterator();
    }

    private function createSkillsIterator()
    {
        return new \ArrayIterator([
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
        self::PHYSICAL;
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
}
