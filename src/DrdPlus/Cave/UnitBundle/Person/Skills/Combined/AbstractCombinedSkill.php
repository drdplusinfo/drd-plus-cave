<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkill;

/**
 * @ORM\Entity()
 * @ORM\Table()
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
  * "abstractCombinedSkill" = "AbstractCombinedSkill",
  * "bigHandwork" = "BigHandwork",
  * "combinedSkills" = "CombinedSkills",
  * "cooking" = "Cooking",
  * "dancing" = "Dancing",
  * "duskSight" = "DuskSight",
  * "fightWithShootingWeapons" = "FightWithShootingWeapons",
  * "firstAid" = "FirstAid",
  * "gambling" = "Gambling",
  * "handingWithAnimals" = "HandingWithAnimals",
  * "handwork" = "Handwork",
  * "herbalism" = "Herbalism",
  * "huntingAndFishing" = "HuntingAndFishing",
  * "knotting" = "Knotting",
  * "painting" = "Painting",
  * "pedagogy" = "Pedagogy",
  * "flayingOnMusicInstrument" = "PlayingOnMusicInstrument",
  * "seduction" = "Seduction",
  * "showmanship" = "Showmanship",
  * "singing" = "Singing",
  * "statuary" = "Statuary"
 * })
 */
abstract class AbstractCombinedSkill extends AbstractSkill
{
    /**
     * @return string[]
     */
    public function getRelatedProperties()
    {
        return [Knack::KNACK, Charisma::CHARISMA];
    }

    /**
     * @return bool
     */
    public function isPhysical()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isPsychical()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isCombined()
    {
        return true;
    }

}
