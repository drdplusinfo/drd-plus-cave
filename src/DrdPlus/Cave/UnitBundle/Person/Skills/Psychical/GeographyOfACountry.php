<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class GeographyOfACountry extends AbstractPsychicalSkill
{
    const GEOGRAPHY_OF_A_COUNTRY = 'geography_of_a_country';

    /**
     * @return string
     */
    public function getName()
    {
        return self::GEOGRAPHY_OF_A_COUNTRY;
    }
}
