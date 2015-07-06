<?php
namespace DrdPlus\Cave\UnitBundle\Person\Background;

use Doctrine\ORM\Mapping as ORM;
use Granam\Strict\Object\StrictObject;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Background extends StrictObject
{
    /**
     * @var BackgroundPoints
     * @ORM\Column(type="background_points")
     */
    private $backgroundPoints;

    /**
     * @var Heritage
     * @ORM\Column(type="heritage")
     */
    private $heritage;

    /**
     * @var BackgroundSkills
     * @ORM\Column(type="background_skills")
     */
    private $backgroundSkills;

    /**
     * @var BelongingsValue
     * @ORM\Column(type="belongings_value")
     */
    private $belongingsValue;

    public function __construct(
        BackgroundPoints $backgroundPoints,
        Heritage $heritage,
        BackgroundSkills $backgroundSkills,
        BelongingsValue $belongingsValue
    )
    {
        $this->backgroundPoints = $backgroundPoints;
        $this->heritage = $heritage;
        $this->backgroundSkills = $backgroundSkills;
        $this->belongingsValue = $belongingsValue;
    }

    /**
     * @return BackgroundPoints
     */
    public function getBackgroundPoints()
    {
        return $this->backgroundPoints;
    }

    /**
     * @return Heritage
     */
    public function getHeritage()
    {
        return $this->heritage;
    }

    /**
     * @return BackgroundSkills
     */
    public function getBackgroundSkills()
    {
        return $this->backgroundSkills;
    }

    /**
     * @return BelongingsValue
     */
    public function getBelongingsValue()
    {
        return $this->belongingsValue;
    }

}
