<?php
namespace DrdPlus\Cave\UnitBundle\Person\ProfessionLevels;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Person\Professions\Fighter;

/**
 * Fighter
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class FighterLevel extends ProfessionLevel
{
    /**
     * Inner link, used by Doctrine only
     * @var ProfessionLevels
     *
     * @ORM\ManyToOne(targetEntity="ProfessionLevels", inversedBy="fighterLevels")
     */
    protected $professionLevels;

    /**
     * @return Fighter
     */
    protected function createProfession()
    {
        return new Fighter();
    }

}
