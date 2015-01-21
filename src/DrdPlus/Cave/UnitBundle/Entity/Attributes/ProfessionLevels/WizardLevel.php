<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Property;

/**
 * Wizard
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class WizardLevel extends ProfessionLevel
{
    const PROFESSION_CODE = 'wizard';

    /**
     * Inner link, used by Doctrine only
     * @var ProfessionLevels
     *
     * @ORM\ManyToOne(targetEntity="ProfessionLevels", inversedBy="wizardLevels")
     */
    private $professionLevels;

    /**
     * @return string[]
     */
    public function getMainPropertyCodes()
    {
        return [
            Property::WILL_CODE,
            Property::INTELLIGENCE_CODE
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
