<?php

namespace DrdPlus\Cave\UnitBundle\Enum\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Enum;

/**
 * Gender
 */
abstract class Gender extends Enum
{
    const FEMALE = 'žena';

    /**
     * @return string
     */
    abstract public function getCode();
}
