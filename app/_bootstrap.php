<?php
require_once __DIR__ . "/autoload.php";

use Doctrine\DBAL\Types\Type;
use \DrdPlus\Cave\UnitBundle\Enum\Races\RaceEnumType;
use \DrdPlus\Cave\UnitBundle\Enum\Races\GenderEnumType;

Type::addType(RaceEnumType::TYPE, RaceEnumType::class);
Type::addType(GenderEnumType::TYPE, GenderEnumType::class);
