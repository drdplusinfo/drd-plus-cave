<?php
namespace DrdPlus\Cave\UnitBundle\Person\ProfessionLevels;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body\WeightInKg;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Person\Professions\Wizard;

/**
 * Wizard
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class WizardLevel extends ProfessionLevel
{
    /**
     * Inner link, used by Doctrine only
     * @var ProfessionLevels
     *
     * @ORM\ManyToOne(targetEntity="ProfessionLevels", inversedBy="wizardLevels")
     */
    protected $professionLevels;

    public function __construct(
        Wizard $wizard,
        LevelRank $levelRank,
        Strength $strengthIncrement,
        Agility $agilityIncrement,
        Knack $knackIncrement,
        Will $willIncrement,
        Intelligence $intelligenceIncrement,
        Charisma $charismaIncrement,
        WeightInKg $weightInKgIncrement,
        \DateTimeImmutable $levelUpAt = null
    )
    {
        parent::__construct(
            $wizard,
            $levelRank,
            $strengthIncrement,
            $agilityIncrement,
            $knackIncrement,
            $willIncrement,
            $intelligenceIncrement,
            $charismaIncrement,
            $weightInKgIncrement,
            $levelUpAt
        );
    }

}
