<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Property;

/**
 * Priest
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class PriestLevel extends ProfessionLevel
{
    const PROFESSION_CODE = 'priest';

    /**
     * Inner link, used by Doctrine only
     * @var ProfessionLevels
     *
     * @ORM\ManyToOne(targetEntity="ProfessionLevels", inversedBy="priestLevels")
     */
    private $professionLevels;

    /**
     * @return string[]
     */
    public function getMainPropertyCodes()
    {
        return [
            Property::CHARISMA_CODE,
            Property::WILL_CODE
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
