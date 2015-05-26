<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;

/**
 * Thief
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class ThiefLevel extends ProfessionLevel
{
    /**
     * Inner link, used by Doctrine only
     * @var ProfessionLevels
     *
     * @ORM\ManyToOne(targetEntity="ProfessionLevels", inversedBy="thiefLevels")
     */
    protected $professionLevels;

    /**
     * @return string[]
     */
    public function getPrimaryPropertyCodes()
    {
        return [
            Agility::getTypeName(),
            Knack::getTypeName()
        ];
    }
}
