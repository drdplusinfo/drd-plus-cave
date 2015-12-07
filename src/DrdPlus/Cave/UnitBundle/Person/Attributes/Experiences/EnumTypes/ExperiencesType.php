<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Experiences\EnumTypes;

use Doctrineum\Integer\IntegerEnumType;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Experiences;

class ExperiencesType extends IntegerEnumType
{
    const EXPERIENCES = Experiences::EXPERIENCES;
}
