<?php
namespace DrdPlus\Cave\TablesBundle\Tables\Experiences;

use DrdPlus\Cave\TablesBundle\Tables\AbstractMeasurement;
use Granam\Integer\Tools\ToInteger;

class ExperiencesMeasurement extends AbstractMeasurement
{
    const EXPERIENCES = 'experiences';
    const EXPERIENCES_TO_LEVEL_BONUS_SHIFT = 15;

    /**
     * @var ExperiencesTable
     */
    private $experiencesTable;

    public function __construct($value, $unit = self::EXPERIENCES, ExperiencesTable $experiencesTable)
    {
        $this->experiencesTable = $experiencesTable;
        parent::__construct($value, $unit);
    }

    public function getPossibleUnits()
    {
        return [self::EXPERIENCES];
    }

    /**
     * @param float $value
     * @param string $unit
     */
    public function addInDifferentUnit($value, $unit)
    {
        $this->checkUnit($unit);
        if ($this->getValue() !== ToInteger::toInteger($value)) {
            throw new \LogicException("Experiences already has a value {$this->getValue()} and can not be replaced by $value");
        }
    }

    /**
     * @return int
     */
    public function toExperiences()
    {
        return ToInteger::toInteger($this->getValue());
    }

    /**
     * @return int
     */
    public function toLevel()
    {
        $bonus = $this->experiencesTable->toBonus($this);

        return $this->experiencesTable->toExperiences($bonus + self::EXPERIENCES_TO_LEVEL_BONUS_SHIFT);
    }

    /**
     * Final level, achieved by sparing current experiences from total zero
     *
     * @return int
     */
    public function toTotalLevel()
    {
        $totalLevel = 0;
        $usedExperience = 0;
        for ($currentExperience = 0; ($currentExperience + $usedExperience) <= $this->toExperiences(); $currentExperience++) {
            $bonus = $this->experiencesTable->experiencesToBonus($currentExperience);
            $level = $this->experiencesTable->toLevel($bonus);
            if ($level > $totalLevel) {
                $totalLevel = $level;
                $usedExperience += $currentExperience;
            }
        }
    }

}
