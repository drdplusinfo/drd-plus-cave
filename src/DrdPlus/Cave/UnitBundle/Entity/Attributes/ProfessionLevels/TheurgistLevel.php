<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Property;

/**
 * Theurgist
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TheurgistLevel extends ProfessionLevel
{
    const PROFESSION_CODE = 'theurgist';

    /**
     * Inner link, used by Doctrine only
     * @var ProfessionLevels
     *
     * @ORM\ManyToOne(targetEntity="ProfessionLevels", inversedBy="theurgistLevels")
     */
    private $professionLevels;

    /**
     * @return string[]
     */
    public function getMainPropertyCodes()
    {
        return [
            Property::INTELLIGENCE_CODE,
            Property::CHARISMA_CODE
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
