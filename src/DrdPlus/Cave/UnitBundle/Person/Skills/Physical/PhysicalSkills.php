<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

use Granam\Strict\Object\StrictObject;

/**
 * PhysicalSkills
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class PhysicalSkills extends StrictObject
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
    /** @var ForestMoving */
    private $forestMoving;
    /** @var MountainMoving */
    private $mountainMoving;
    /** @var Riding */
    private $riding;
    /** @var Sailing */
    private $sailing;
    /** @var ShieldUsage */
    private $shieldUsage;
    /** @var Swimming */
    private $swimming;

    public function __construct()
    {
        $this->armorWearing = new ArmorWearing();
        $this->athletics = new Athletics();
        $this->blacksmithing = new Blacksmithing();
        $this->boatDriving = new BoatDriving();
        $this->cartDriving = new CartDriving();
        $this->cityMoving = new CityMoving();
        $this->climbingAndHillwalking = new ClimbingAndHillwalking();
        $this->fastMarsh = new FastMarsh();
        $this->forestMoving = new ForestMoving();
        $this->mountainMoving = new MountainMoving();
        $this->riding = new Riding();
        $this->sailing = new Sailing();
        $this->shieldUsage = new ShieldUsage();
        $this->swimming = new Swimming();
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
     * @return ForestMoving
     */
    public function getForestMoving()
    {
        return $this->forestMoving;
    }

    /**
     * @return MountainMoving
     */
    public function getMountainMoving()
    {
        return $this->mountainMoving;
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
