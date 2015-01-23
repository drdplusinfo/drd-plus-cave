<?php
error_reporting(-1);
ini_set('display_errors', true);

require_once __DIR__ . "/autoload.php";

use Doctrine\DBAL\Types\Type;
use \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\RaceEnumType;
use \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\GenderEnumType;

Type::addType(RaceEnumType::TYPE, RaceEnumType::class);
Type::addType(GenderEnumType::TYPE, GenderEnumType::class);
