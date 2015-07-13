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
use DrdPlus\Cave\UnitBundle\Person\Professions\Ranger;

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

    public function __construct(
        Ranger $ranger,
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
            $ranger,
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
