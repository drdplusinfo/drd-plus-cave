<?php
require_once __DIR__ . '/vendor/autoload.php';
error_reporting(-1);
ini_set('display_errors', true);
ini_set('xdebug.max_nesting_level', 100);
$_SERVER['KERNEL_DIR'] = __DIR__ . '/app';

$drdPlusCaveUnitBundle = new \DrdPlus\Cave\UnitBundle\DrdPlusCaveUnitBundle();
$drdPlusCaveUnitBundle->boot();
