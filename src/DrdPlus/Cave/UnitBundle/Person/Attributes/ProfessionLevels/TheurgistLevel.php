<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;

/**
 * Theurgist
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TheurgistLevel extends ProfessionLevel
{
    const THEURGIST = 'theurgist';

    /**
     * Inner link, used by Doctrine only
     * @var ProfessionLevels
     *
     * @ORM\ManyToOne(targetEntity="ProfessionLevels", inversedBy="theurgistLevels")
     */
    protected $professionLevels;

    /**
     * @return string[]
     */
    public function getPrimaryPropertyCodes()
    {
        return [
            Intelligence::getTypeName(),
            Charisma::getTypeName()
        ];
    }
}
