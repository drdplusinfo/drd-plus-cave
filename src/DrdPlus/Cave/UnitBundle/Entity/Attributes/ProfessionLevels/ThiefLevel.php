<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Property;

/**
 * Thief
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class ThiefLevel extends ProfessionLevel
{
    const PROFESSION_CODE = 'thief';

    /**
     * Inner link, used by Doctrine only
     * @var ProfessionLevels
     *
     * @ORM\ManyToOne(targetEntity="ProfessionLevels", inversedBy="thiefLevels")
     */
    private $professionLevels;

    /**
     * @return string[]
     */
    public function getMainPropertyCodes()
    {
        return [
            Property::AGILITY_CODE,
            Property::KNACK_CODE
        ];
    }

    /**
     * @return string
     */
    public function getProfessionCode()
    {
        return self::PROFESSION_CODE;
    }
}
