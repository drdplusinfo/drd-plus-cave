<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\LevelOfProfession;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Property;

/**
 * Ranger
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RangerLevel extends ProfessionLevel
{
    const LABEL = 'Hraničář';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="professionLevel", type="integer")
     */
    private $professionLevel;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $professionLevel
     * @return $this
     */
    public function setProfessionLevel($professionLevel)
    {
        $this->professionLevel = $professionLevel;

        return $this;
    }

    /**
     * @return integer
     */
    public function getProfessionLevel()
    {
        return $this->professionLevel;
    }

    /**
     * Get name of the profession
     *
     * @return string
     */
    public function getLabel()
    {
        return self::LABEL;
    }

    /**
     * @return string[]
     */
    public function getMainPropertyCodes()
    {
        return [
            Property::KNACK_CODE,
            Property::STRENGTH_CODE
        ];
    }

}