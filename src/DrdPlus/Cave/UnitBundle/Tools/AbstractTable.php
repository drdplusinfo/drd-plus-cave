<?php
namespace DrdPlus\Cave\UnitBundle\Tools;

use Granam\Integer\Tools\ToInteger;

abstract class AbstractTable implements TableInterface
{
    /** @var array */
    private $data;
    /** @var array */
    private $axisX;
    /** @var array */
    private $axisY;

    public function __construct()
    {
        $this->data = $this->fetchData();
    }

    /**
     * @return array
     */
    private function fetchData()
    {
        $rawData = $this->fetchFromFile($this->getDataFileName());
        list($data, $axisX, $axisY) = $this->parseHeadersAndValues($rawData);
        $this->axisX = $axisX;
        $this->axisY = $axisY;

        return $data;
    }

    /**
     * @return string
     */
    abstract protected function getDataFileName();

    private function fetchFromFile($dataSourceFile)
    {
        $resource = fopen($dataSourceFile, 'r');
        if (!$resource) {
            throw new \RuntimeException("File with table data could not be read from $dataSourceFile");
        }
        $data = [];
        do {
            $row = fgetcsv($resource);
            if (count($row) > 0 && $row !== false) { // otherwise skipp empty row
                $data[] = $row;
            }
        } while (is_array($row));

        if (!$data) {
            throw new \RuntimeException("No data have been read from $dataSourceFile");
        }

        return $data;
    }

    private function parseHeadersAndValues(array $rawData)
    {
        $columnIndexesWithAxisY = [];
        $expectedAxisYHeader = $this->getExpectedAxisYDataHeader(); // the very first columns of data
        $axisYHeaderNames = [];
        foreach ($expectedAxisYHeader as $rowIndexWithAxisXHeader => $expectedAxisYHeaderRow) {
            if (!isset($rawData[$rowIndexWithAxisXHeader])) {
                throw new \LogicException();
            }
            $axisYHeaderNames[$rowIndexWithAxisXHeader] = [];
            foreach ($expectedAxisYHeaderRow as $dataColumnIndex => $expectedAxisYHeaderName) {
                if (!isset($rawData[$rowIndexWithAxisXHeader][$dataColumnIndex])) {
                    throw new \LogicException;
                }
                if ($rawData[$rowIndexWithAxisXHeader][$dataColumnIndex] !== $expectedAxisYHeaderName) {
                    throw new \RuntimeException(
                        "Data file is corrupted. Expected header with name '$expectedAxisYHeaderName' on row "
                        . ($rowIndexWithAxisXHeader + 1) . " and column " . ($dataColumnIndex + 1)
                    );
                }
                $axisYHeaderNames[$rowIndexWithAxisXHeader][$dataColumnIndex] = $expectedAxisYHeaderName;
                $columnIndexesWithAxisY[] = $dataColumnIndex;
            }
        }
        $columnIndexesWithAxisY = array_unique($columnIndexesWithAxisY);

        $rowIndexesWithAxisXHeader = [];
        $columnIndexesWithAxisYCount = count($columnIndexesWithAxisY);
        $expectedAxisXHeader = $this->getExpectedAxisXCompleteHeader(); // the very first rows of data
        $axisXHeaderValuesPerColumn = [];
        foreach ($expectedAxisXHeader as $rowIndexWithAxisXHeader => $expectedAxisXHeaderRow) {
            if (!isset($rawData[$rowIndexWithAxisXHeader])) {
                throw new \LogicException();
            }
            foreach ($expectedAxisXHeaderRow as $dataColumnIndex => $expectedAxisXHeaderValue) {
                $rawDataColumnIndex = $dataColumnIndex + $columnIndexesWithAxisYCount; // including not-yet-removed axis Y header columns
                if (!isset($rawData[$rowIndexWithAxisXHeader][$rawDataColumnIndex])) {
                    throw new \LogicException;
                }
                if ($rawData[$rowIndexWithAxisXHeader][$rawDataColumnIndex] !== $expectedAxisXHeaderValue) {
                    throw new \RuntimeException(
                        "Data file is corrupted. Expected axis X header with value $expectedAxisXHeaderValue on row "
                        . ($rowIndexWithAxisXHeader + 1) . " and column " . ($rawDataColumnIndex + 1)
                    );
                }
                if (!isset($axisXHeaderValuesPerColumn[$dataColumnIndex])) {
                    $axisXHeaderValuesPerColumn[$dataColumnIndex] = [];
                }
                $axisXHeaderValuesPerColumn[$dataColumnIndex][$rowIndexWithAxisXHeader] = $expectedAxisXHeaderValue; // grouped per column, ordered by row
            }
            $rowIndexesWithAxisXHeader[] = $rowIndexWithAxisXHeader;
        }

        // remove axis X header
        foreach ($rowIndexesWithAxisXHeader as $rowIndexWithAxisXHeader) {
            unset($rawData[$rowIndexWithAxisXHeader]);
        }
        $dataWithAxisYValues = array_merge($rawData); // fixing number-indexes sequence ([1=>foo, 3=>bar] = [0=>foo, 1=>bar])

        $axisY = []; // value to data row index
        foreach ($axisYHeaderNames as $headerRowIndex => $axisYRow) {
            foreach ($axisYRow as $dataColumnIndex => $axisYName) {
                foreach ($dataWithAxisYValues as $dataRowIndex => $dataRow) {
                    $axisYHeaderValue = $dataRow[$dataColumnIndex];
                    if (isset($axisY[$axisYHeaderValue])) {
                        throw new \LogicException('Axis Y header column values have to be unique, got twice ' . $axisYHeaderValue);
                    }
                    $axisY[$axisYHeaderValue] = $dataRowIndex; // what row is for what value
                }
            }
        }

        // remove axis Y header
        foreach (array_keys($dataWithAxisYValues) as $rowIndex) {
            foreach ($columnIndexesWithAxisY as $columnIndexWithAxisY) {
                unset($dataWithAxisYValues[$rowIndex][$columnIndexWithAxisY]);
            }
            $dataWithAxisYValues[$rowIndex] = array_merge($dataWithAxisYValues[$rowIndex]); // fixing number-indexes sequence ([1=>foo, 3=>bar] = [0=>foo, 1=>bar])
        }
        $data = $dataWithAxisYValues; // pure values without header

        $axisX = []; // header values to data column index
        foreach ($axisXHeaderValuesPerColumn as $dataColumnIndex => $axisXColumnHeaderValues) {
            $firstAxisXColumnValue = array_shift($axisXColumnHeaderValues);
            if (!isset($axisX[$firstAxisXColumnValue])) {
                $axisX[$firstAxisXColumnValue] = [];
            }
            $tail = &$axisX[$firstAxisXColumnValue];
            foreach ($axisXColumnHeaderValues as $nextAxisXColumnHeaderValue) {
                if (!isset($tail[$nextAxisXColumnHeaderValue])) {
                    $tail[$nextAxisXColumnHeaderValue] = [];
                }
                $tail = &$tail[$nextAxisXColumnHeaderValue];
            }
            $tail = $dataColumnIndex; // the very last, deepest indexed value is an index of column, where pointed data lays
        }

        foreach ($data as $rowIndex => $dataRow) {
            $data[$rowIndex] = $this->formatRowData($dataRow);
        }

        return [$data, $axisX, $axisY];
    }

    /**
     * @return array
     */
    abstract protected function getExpectedAxisXCompleteHeader();

    /**
     * @return array
     */
    abstract protected function getExpectedAxisYDataHeader();

    private function formatRowData(array $row)
    {
        foreach ($row as $columnIndex => $value) {
            $value = $this->parseValue($value);
            if ($value === '') {
                unset($row[$columnIndex]);
            } else {
                $row[$columnIndex] = $value;
            }
        }

        return $row;
    }

    private function parseValue($value)
    {
        $value = trim($value);
        if ($value === '') {
            return $value;
        }

        return ToInteger::toInteger($this->parseNumber($value));
    }

    private function parseNumber($value)
    {
        return str_replace('−' /* ASCII 226 */, '-' /* ASCII 45 */, $value);
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function getAxisX()
    {
        return $this->axisX;
    }

    /**
     * @return array
     */
    public function getAxisY()
    {
        return $this->axisY;
    }

    /**
     * @param array $verticalCoordinates
     * @param array $horizontalCoordinates
     *
     * @return int|false
     */
    public function getValue(array $verticalCoordinates, array $horizontalCoordinates)
    {
        $row = $this->findByIndexes($this->getData(), $this->getAxisY(), $verticalCoordinates);
        if (!is_array($row)) {
            return false;
        }

        $value = $this->findByIndexes($row, $this->getAxisX(), $horizontalCoordinates);
        if (!is_numeric($value)) {
            throw new \LogicException(
                'Value has not been found for vertical coordinates  ' . var_export($verticalCoordinates, true)
                . ' and horizontal coordinates ' . var_export($horizontalCoordinates, true)
            );
        }

        return $value;
    }

    private function findByIndexes(array $data, array $axis, array $indexes)
    {
        $dataIndex = false;
        foreach ($indexes as $index) {
            if (!is_array($axis) || !array_key_exists($index, $axis)) {
                return false;
            }
            $dataIndex = $axis = $axis[$index];
        }

        if (!is_int($dataIndex)) {
            return false;
        }

        if (!isset($data[$dataIndex])) {
            throw new \LogicException;
        }

        return $data[$dataIndex];
    }
}
