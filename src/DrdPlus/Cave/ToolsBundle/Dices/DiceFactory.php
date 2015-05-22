<?php
namespace DrdPlus\Cave\ToolsBundle\Dices;

use Granam\Strict\Object\StrictObject;

class DiceFactory extends StrictObject
{
    /**
     * @param \Drd\DiceRoll\DiceInterface $dice
     * @return Dice
     */
    public static function createDice(\Drd\DiceRoll\DiceInterface $dice)
    {
        return new Dice($dice);
    }
}
