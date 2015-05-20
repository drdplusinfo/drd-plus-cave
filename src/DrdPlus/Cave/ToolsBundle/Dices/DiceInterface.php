<?php
namespace DrdPlus\Cave\ToolsBundle\Dices;

interface DiceInterface
{
    /**
     * @return int
     */
    public function getMinimum();

    /**
     * @return int
     */
    public function getMaximum();
}
