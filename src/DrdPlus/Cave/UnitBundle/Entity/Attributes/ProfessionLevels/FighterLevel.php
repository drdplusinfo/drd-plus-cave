<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Property;

/**
 * Fighter
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class FighterLevel extends ProfessionLevel
{
    const PROFESSION_CODE = 'fighter';

    /**
     * Inner link, used by Doctrine only
     * @var ProfessionLevels
     *
     * @ORM\ManyToOne(targetEntity="ProfessionLevels", inversedBy="fighterLevels")
     */
    private $professionLevels;

    /**
     * @return string[]
     */
    public function getMainPropertyCodes()
    {
        return [
            Property::STRENGTH_CODE,
            Property::AGILITY_CODE
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
