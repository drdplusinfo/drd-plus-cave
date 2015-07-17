<?php
namespace DrdPlus\Cave\UnitBundle;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Choices\ExceptionalityChoice;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Fates\AbstractFateEntity;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Experiences\ExperiencesType;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Name;
use DrdPlus\Cave\UnitBundle\Person\Background\BackgroundSkills;
use DrdPlus\Cave\UnitBundle\Person\Background\BelongingsValue;
use DrdPlus\Cave\UnitBundle\Person\Background\Heritage;
use DrdPlus\Cave\UnitBundle\Person\Background\Parts\BackgroundPointsType;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\LevelRank;
use DrdPlus\Cave\UnitBundle\Person\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Races\Race;
use DrdPlus\Properties\Agility;
use DrdPlus\Properties\Body\WeightInKg;
use DrdPlus\Properties\Charisma;
use DrdPlus\Properties\Intelligence;
use DrdPlus\Properties\Knack;
use DrdPlus\Properties\Strength;
use DrdPlus\Properties\Will;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DrdPlusCaveUnitBundle extends Bundle
{
    public function boot()
    {
        $this->registerEnums();
    }

    private function registerEnums()
    {
        Name::registerSelf();
        // only the generic race has to be registered, sub-races are registered automatically
        Race::registerSelf();
        // only the generic gender has to be registered, sub-race genders are registered automatically
        Gender::registerSelf();
        // only the generic choice has to be registered, specific choices are registered automatically
        ExceptionalityChoice::registerSelf();
        // only the generic kind has to be registered, specific kinds are registered automatically
        AbstractFateEntity::registerSelf();

        Strength::registerSelf();
        Agility::registerSelf();
        Knack::registerSelf();
        Will::registerSelf();
        Intelligence::registerSelf();
        Charisma::registerSelf();
//        WeightInKg::registerSelf();

        LevelRank::registerSelf();
        ExperiencesType::registerSelf();

        BackgroundPointsType::registerSelf();
        BackgroundSkills::registerSelf();
        BelongingsValue::registerSelf();
        Heritage::registerSelf();
    }
}
