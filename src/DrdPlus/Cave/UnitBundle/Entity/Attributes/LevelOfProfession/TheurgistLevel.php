<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\LevelOfProfession;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Property;

/**
 * Theurgist
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TheurgistLevel extends ProfessionLevel
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
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $professionLevel;

    /**
     * Get id
     *
     * @return int
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
     * @return int
     */
    public function getProfessionLevel()
    {
        return $this->professionLevel;
    }

    /**
     * @return string[]
     */
    public function getMainPropertyCodes()
    {
        return [
            Property::INTELLIGENCE_CODE,
            Property::CHARISMA_CODE
        ];
    }

}
