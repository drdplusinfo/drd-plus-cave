<?php
namespace DrdPlus\Cave\ToolsBundle\Dices;

use Granam\Strict\Object\StrictObject;

class Roll extends StrictObject
{

    /**
     * @var array|DiceRoll[]
     */
    private $diceRolls;

    /**
     * @param array|DiceRoll[] $diceRolls
     */
    public function __construct(array $diceRolls)
    {
        $this->checkDiceRolls($diceRolls);
        $this->diceRolls = $diceRolls;
    }

    private function checkDiceRolls(array $diceRolls)
    {
        foreach ($diceRolls as $diceRoll) {
            if (!is_object($diceRoll)) {
                throw new \RuntimeException(
                    'Given dice roll is not an object, but ' . gettype($diceRoll)
                );
            }
            if (!is_a($diceRoll, DiceRoll::class)) {
                throw new \RuntimeException(
                    'Given dice roll is not an instance of DiceRoll, but ' . get_class($diceRoll)
                );
            }
        }
    }

    /**
     * @return int
     */
    public function getRollSummary()
    {
        return array_sum(
            array_map(
                function (DiceRoll $diceRoll) {
                    return $diceRoll->getEvaluatedValue();
                },
                $this->diceRolls
            )
        );
    }
}
