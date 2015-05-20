<?php
namespace DrdPlus\Cave\ToolsBundle\Dices;

use Granam\Strict\Integer\StrictInteger;
use Granam\Strict\Object\StrictObject;

/**
 * @ORM\Table
 * @ORM\Entity
 */
// TODO switch entity type to value object from Doctrine 2.5
class Dice extends StrictObject implements DiceInterface
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $minimum;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $maximum;

    public function __construct(\Drd\DiceRoll\DiceInterface $dice)
    {
        $this->minimum = $dice->getMinimum()->getValue();
        $this->maximum = $dice->getMaximum()->getValue();
    }

    /**
     * @return int
     */
    public function getMinimum()
    {
        return $this->minimum;
    }

    /**
     * @return StrictInteger
     */
    public function getMaximum()
    {
        return $this->maximum;
    }


}
