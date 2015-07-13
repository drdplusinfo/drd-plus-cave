<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class MapsDrawing extends AbstractPsychicalSkill
{
    const MAPS_DRAWING = 'maps_drawing';

    /**
     * @return string
     */
    public function getName()
    {
        return self::MAPS_DRAWING;
    }
}
