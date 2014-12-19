<?php
require_once __DIR__ . "/autoload.php";

use Doctrine\DBAL\Types\Type;

Type::addType(\DrdPlus\Cave\UnitBundle\Enum\Races\RaceEnumType::TYPE, \DrdPlus\Cave\UnitBundle\Enum\Races\RaceEnumType::class);
Type::addType(\DrdPlus\Cave\UnitBundle\Enum\Races\Genders\GenderEnumType::TYPE, \DrdPlus\Cave\UnitBundle\Enum\Races\Genders\GenderEnumType::class);
