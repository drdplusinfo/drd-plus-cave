<?php
namespace DrdPlus\Cave\UnitBundle;

use DrdPlus\Person\EnumTypes\PersonEnumsRegistrar;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DrdPlusCaveUnitBundle extends Bundle
{
    public function boot()
    {
        PersonEnumsRegistrar::registerAll();
    }
}
