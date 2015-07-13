<?php
namespace DrdPlus\Cave\TablesBundle\Tables\Experiences;

use DrdPlus\Cave\TablesBundle\Tables\MeasurementInterface;
use DrdPlus\Cave\TablesBundle\Tables\TableInterface;
use DrdPlus\Cave\TablesBundle\Tables\Wounds\WoundsMeasurement;
use DrdPlus\Cave\TablesBundle\Tables\Wounds\WoundsTable;
use Granam\Integer\Tools\ToInteger;
use Granam\Strict\Object\StrictObject;

/**
 * PPH page 44, top right
 */
class ExperiencesTable extends StrictObject implements TableInterface
{
    /**
     * @var \DrdPlus\Cave\TablesBundle\Tables\Wounds\WoundsTable
     */
    private $woundsTable;

    public function __construct(WoundsTable $woundsTable)
    {
        // experiences has the very same conversions as wounds have
        $this->woundsTable = $woundsTable;
    }

    /**
     * @param MeasurementInterface $experiencesMeasurement
     *
     * @return int
     */
    public function toBonus(MeasurementInterface $experiencesMeasurement)
    {
        return $this->woundsTable->woundsToBonus($experiencesMeasurement->getValue());
    }

    /**
     * @param int $bonus
     * @param string $unit
     *
     * @return ExperiencesMeasurement
     */
    public function toMeasurement($bonus, $unit = ExperiencesMeasurement::EXPERIENCES)
    {
        $wounds = $this->woundsTable->toMeasurement($bonus, WoundsMeasurement::WOUNDS);
        $experiences = new ExperiencesMeasurement($wounds->getValue(), $unit, $this);

        switch ($unit) {
            case ExperiencesMeasurement::EXPERIENCES :
                return $experiences;
            case LevelMeasurement::LEVEL :
                return new LevelMeasurement($experiences->toLevel(), LevelMeasurement::LEVEL, $this);
            default :
                throw new \LogicException("Unknown unit $unit");
        }
    }

    /**
     * @param float $amount
     *
     * @return int
     */
    public function experiencesToBonus($amount)
    {
        return $this->woundsTable->woundsToBonus($amount);
    }

    /**
     * @param int $bonus
     *
     * @return int
     */
    public function toExperiences($bonus)
    {
        return ToInteger::toInteger($this->toMeasurement($bonus, ExperiencesMeasurement::EXPERIENCES)->getValue());
    }

    /**
     * @param int $bonus
     *
     * @return int
     */
    public function toLevel($bonus)
    {
        return $this->toMeasurement($bonus, LevelMeasurement::LEVEL)->toLevel();
    }
}
