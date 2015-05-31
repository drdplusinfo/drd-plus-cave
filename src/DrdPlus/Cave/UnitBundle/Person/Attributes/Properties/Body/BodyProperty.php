<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body;

interface BodyProperty
{

    /**
     * @return string
     */
    public function getName();

    /**
     * @return int
     */
    public function getValue();
}
