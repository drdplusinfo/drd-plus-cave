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

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

}
