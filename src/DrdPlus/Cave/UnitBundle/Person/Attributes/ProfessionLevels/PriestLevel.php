<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Person\Professions\Priest;

/**
 * Priest
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class PriestLevel extends ProfessionLevel
{
    /**
     * Inner link, used by Doctrine only
     * @var ProfessionLevels
     *
     * @ORM\ManyToOne(targetEntity="ProfessionLevels", inversedBy="priestLevels")
     */
    protected $professionLevels;

    /**
     * @return Priest
     */
    protected function createProfession()
    {
        return new Priest();
    }


}
