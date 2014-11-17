<?php

namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Professions;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Property;

/**
 * Theurgist
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Theurgist extends Profession
{
    const LABEL = 'Theurg';

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
            Property::STRENGTH_SHORT_LABEL => Property::STRENGTH_LABEL,
            Property::AGILITY_SHORT_LABEL => Property::AGILITY_LABEL,
        ];
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return Theurgist
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
