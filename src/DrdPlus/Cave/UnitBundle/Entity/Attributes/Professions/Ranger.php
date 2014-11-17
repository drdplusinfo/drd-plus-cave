<?php

namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Professions;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Property;

/**
 * Ranger
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Ranger extends Profession
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
     * @ORM\Column(name="level", type="smallint")
     */
    private $level;

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

    /**
     * Set level
     *
     * @param integer $level
     * @return Ranger
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }
}
