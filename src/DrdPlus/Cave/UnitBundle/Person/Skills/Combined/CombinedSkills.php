<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

use Granam\Strict\Object\StrictObject;

/**
 * CombinedSkills
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class CombinedSkills extends StrictObject
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
