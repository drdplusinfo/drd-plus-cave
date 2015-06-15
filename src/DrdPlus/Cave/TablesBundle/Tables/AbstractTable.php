<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

abstract class AbstractTable
{

    /**
     * @var string[]
     */
    private $data;

    public function __construct()
    {
        $this->data = $this->loadData();
    }

    /**
     * @return array
     */
    private function loadData()
    {
        $rawData = $this->fetchFromFile($this->getDataFileName());
        $indexed = $this->indexData($rawData);

        return $indexed;
    }

    private function fetchFromFile($dataSourceFile)
    {
        $resource = fopen($dataSourceFile, 'r');
        if (!$resource) {
            throw new \RuntimeException("File with weight table data could not be read from $dataSourceFile");
        }
        $data = [];
        do {
            $row = fgetcsv($resource);
            if (count($row) > 0) { // otherwise skipp empty row
                $data[] = $row;
            }
        } while (is_array($row));

        if (!$data) {
            throw new \RuntimeException("No weight data have been read from $dataSourceFile");
        }

        return $data;
    }

    private function indexData(array $data)
    {
        $expectedHeader = array_merge(['bonus'], $this->getExpectedDataHeader());
        if (!isset($data[0]) || $data[0] !== $expectedHeader) {
            throw new \RuntimeException('Data file is corrupted. Expected header with values ' . implode(',', $expectedHeader));
        }
        $indexed = [];
        unset($data[0]); // removing human header
        foreach ($data as $row) {
            if (!empty($row)) {
                $indexedRow = $this->indexRow($row, $expectedHeader);
                $indexed[key($indexedRow)] = current($indexedRow);
            }
        }
        if (count($indexed) !== $this->getExpectedDataRowsCount()) {
            throw new \RuntimeException(
                "Data file is corrupted. Expected {$this->getExpectedDataRowsCount()} rows with data (header excluded), fetched " . count($indexed)
            );
        }

        return $indexed;
    }

    private function indexRow(array $row, array $expectedHeader)
    {
        $indexedValues = array_combine($expectedHeader, $row);
        $bonus = $indexedValues['bonus'];
        unset($indexedValues['bonus']); // left values only
        $indexedRow[$bonus] = array_map( // every value convert from string to float
            function ($value) {
                return floatval($value);
            },
            $indexedValues
        );

        return $indexedRow;
    }

    /**
     * @return \string[]
     */
    abstract protected function getExpectedDataHeader();

    /**
     * @return int
     */
    abstract protected function getExpectedDataRowsCount();

    /**
     * @return string
     */
    abstract protected function getDataFileName();

    /**
     * @param int $bonus
     *
     * @return float
     */
    public function toMeasurement($bonus)
    {
        if (!isset($this->data[$bonus])) {
            throw new \OutOfRangeException("Value to bonus $bonus is not defined.");
        }

        foreach ($this->getExpectedDataHeader() as $unit) {
            if (isset($this->data[$bonus][$unit])) {
                $value = $this->data[$bonus][$unit];

                return $this->convertToMeasurement($value, $unit);
            }
        }

        throw new \LogicException(
            "Missing data for bonus $bonus and expected data columns " . implode(',', $this->getExpectedDataHeader())
        );
    }

    /**
     * @param float $value
     * @param string $unit
     *
     * @return MeasurementInterface
     */
    abstract protected function convertToMeasurement($value, $unit);

    /**
     * @param MeasurementInterface $measurement
     *
     * @return int
     */
    public function toBonus(MeasurementInterface $measurement)
    {
        $searchedUnit = $measurement->getUnit();
        $searchedValue = $measurement->getValue();
        $finds = $this->findBonusMatchingTo($searchedValue, $searchedUnit);
        if (is_float($finds)) {
            return $finds; // we found the bonus by value exact match
        }

        return $this->getBonusClosestTo($searchedValue, $finds['lower'], $finds['higher']);
    }

    private function findBonusMatchingTo($searchedValue, $searchedUnit)
    {
        $closest = ['lower' => [], 'higher' => []];
        foreach ($this->getData() as $bonus => $relatedValues) {
            if (!isset($relatedValues[$searchedUnit])) {
                continue;
            }
            $relatedValue = $relatedValues[$searchedUnit];
            if ($relatedValue === $searchedValue) {
                return $bonus; // we found exact match
            }
            if ($searchedValue > $relatedValue) {
                if (empty($closest['lower']) || key($closest['lower']) < $relatedValue) {
                    $closest['lower'] = [$relatedValue => [$bonus]]; // new value to [bonus] pair
                } else if (!empty($closest['lower']) && key($closest['lower']) === $relatedValue) {
                    $closest['lower'][$relatedValue][] = $bonus; // adding bonus for same value
                }
            }
            if ($searchedValue < $relatedValue) {
                if (empty($closest['higher']) || key($closest['higher']) > $relatedValue) {
                    $closest['higher'] = [$relatedValue => [$bonus]]; // new value to bonus pair
                } else if (!empty($closest['higher']) && key($closest['higher']) === $relatedValue) {
                    $closest['higher'][$relatedValue][] = $bonus; // adding bonus for same value
                }
            }
        }

        return $closest;
    }

    private function getBonusClosestTo($searchedValue, array $closestLower, $closestHigher)
    {
        $closerValue = $this->getCloserValue($searchedValue, key($closestLower), key($closestHigher));
        if ($closerValue !== false) {
            if (isset($closestLower[$closerValue])) {
                $bonuses = $closestLower[$closerValue];
            } else {
                $bonuses = $closestHigher[$closerValue];
            }

            // matched single table-value, maybe with more bonuses, the lowest bonus should be taken
            return min($bonuses); // PPH page 11, right column
        } else {
            // both table border-values are equally close to the value, we will choose from bonuses of both borders
            $bonuses = array_merge($closestLower, $closestHigher);

            // matched two table-values, more bonuses for sure, the highest bonus should be taken
            return max($bonuses); // PPH page 11, right column
        }
    }

    private function getCloserValue($toValue, $firstValue, $secondValue)
    {
        $firstDifference = $toValue - $firstValue;
        $secondDifference = $toValue - $secondValue;
        if (abs($firstDifference) < abs($secondDifference)) {
            return $firstValue;
        }
        if (abs($secondDifference) < abs($firstDifference)) {
            return $secondValue;
        }

        return false; // differences are equal
    }

    /**
     * @return \string[]
     */
    protected function getData()
    {
        return $this->data;
    }
}
