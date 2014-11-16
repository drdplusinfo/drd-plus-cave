<?php

namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Professions;

/**
 * Profession
 */
abstract class Profession
{

    /**
     * Get name of the profession
     *
     * @return string
     */
    abstract public function getLabel();

    /**
     * @return string[]
     */
    abstract public function getMainProperties();

    /**
     * @return int
     */
    abstract public function getLevel();
}
