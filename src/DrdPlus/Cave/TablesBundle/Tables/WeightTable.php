<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

/**
 * PPH page 164, bottom
 */
class WeightTable implements Table
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
        $rawData = $this->fetchFromFile(__DIR__ . '/data/weight.csv');
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
        if (!isset($data[0]) || count($data[0]) < 2 || $data[0][0] !== 'bonus' || $data[0][1] !== 'kg') {
            throw new \RuntimeException('Weight data file is corrupted. Header with bonus and kg is missing.');
        }
        $indexed = [];
        unset($data[0]); // removing human header
        foreach ($data as $row) {
            if (!empty($row)) {
                $indexed[intval($row[0])] /* bonus */ = ['kg' => floatval($row[1]) /* kg */];
            }
        }
        if (count($indexed) !== 100) {
            throw new \RuntimeException('Weight data file is corrupted. Expected 100 rows with numbers, fetched ' . count($indexed));
        }

        return $indexed;
    }

    /**
     * @param int $bonus
     *
     * @return float
     */
    public function toKg($bonus)
    {
        return $this->toValue($bonus);
    }

    /**
     * @param int
     *
     * @return float
     */
    public function toValue($bonus)
    {
        if (!isset($this->data[$bonus])) {
            throw new \OutOfRangeException("Value to bonus $bonus is not defined.");
        }

        return $this->data[$bonus]['kg'];
    }

    /**
     * @param float $value
     *
     * @return int
     */
    public function toBonus($value)
    {
        $value = floatval($value);
        $closestLower = [];
        $closestHigher = [];
        foreach ($this->data as $bonus => $relatedValues) {
            if ($value === $relatedValues['kg']) {
                return $bonus; // we found exact match
            }
            if ($value > $relatedValues['kg']) {
                if (empty($closestLower) || key($closestLower) /* kg */ < $relatedValues['kg']) {
                    $closestLower = [$relatedValues['kg'] => [$bonus]]; // new value to bonus pair
                } else if (!empty($closestLower) && key($closestLower) /* kg */ === $relatedValues['kg']) {
                    $closestLower[$relatedValues['kg']][] = $bonus; // adding bonus for same value
                }
            }
            if ($value < $relatedValues['kg'] && (empty($closestHigher) || key($closestHigher) > $relatedValues['kg'])) {
                $closestHigher = [$relatedValues['kg'] => [$bonus]];
            }
        }
        $closerValue = $this->getCloserValue($value, key($closestLower), key($closestHigher));
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
}
