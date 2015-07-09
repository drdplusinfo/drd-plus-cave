<?php
namespace DrdPlus\Cave\ToolsBundle\Dices;

use Granam\Strict\Object\StrictObject;

/**
 * @ORM\Table
 * @ORM\Entity
 */
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
     * @return int
     */
    public function getMaximum()
    {
        return $this->maximum;
    }


}
