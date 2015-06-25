<?php
namespace DrdPlus\Cave\UnitBundle\Person\ProfessionLevels;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Person\Professions\Theurgist;

/**
 * Theurgist
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TheurgistLevel extends ProfessionLevel
{

    /**
     * Inner link, used by Doctrine only
     * @var ProfessionLevels
     *
     * @ORM\ManyToOne(targetEntity="ProfessionLevels", inversedBy="theurgistLevels")
     */
    protected $professionLevels;

    /**
     * @return Theurgist
     */
    protected function createProfession()
    {
        return new Theurgist();
    }

}
