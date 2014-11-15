<?php

namespace DrdPlus\Cave\UnitBundle\Entity\Attributes;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gender
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Gender
{
    const MALE = 'muž';
    const FEMALE = 'žena';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="genderName", type="string", length=255)
     */
    private $genderName;

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
     * Set name
     *
     * @param string $genderName
     * @return Gender
     */
    public function setGenderName($genderName)
    {
        $this->genderName = $genderName;

        return $this;
    }

    /**
     * Get gender name
     *
     * @return string 
     */
    public function getGenderName()
    {
        return $this->genderName;
    }
}
