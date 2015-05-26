<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;

/**
 * Ranger
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RangerLevel extends ProfessionLevel
{
    /**
     * Inner link, used by Doctrine only
     * @var ProfessionLevels
     *
     * @ORM\ManyToOne(targetEntity="ProfessionLevels", inversedBy="rangerLevels")
     */
    protected $professionLevels;

    /**
     * @return string[]
     */
    public function getPrimaryPropertyCodes()
    {
        return [
            Knack::getTypeName(),
            Strength::getTypeName()
        ];
    }
}
