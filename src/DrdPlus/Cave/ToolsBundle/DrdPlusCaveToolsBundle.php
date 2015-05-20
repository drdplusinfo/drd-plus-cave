<?php

namespace DrdPlus\Cave\ToolsBundle;

use DrdPlus\Cave\ToolsBundle\Enum\DiceRoll1d6;
use DrdPlus\Cave\ToolsBundle\Enum\DiceRoll2d6Plus;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DrdPlusCaveToolsBundle extends Bundle
{
    public function boot()
    {
        $this->registerEnums();
    }

    private function registerEnums()
    {
        DiceRoll1d6::registerSelf();
        DiceRoll2d6Plus::registerSelf();
    }
}
