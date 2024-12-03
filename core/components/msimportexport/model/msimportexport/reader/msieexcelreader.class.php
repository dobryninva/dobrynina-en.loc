<?php
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Collection\CellsFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

class ReadFilter implements IReadFilter
{
    private $_startRow = 0;
    private $_endRow = 0;

    /**
     * Set the list of rows that we want to read
     * @param int $startRow
     * @param int $chunkSize
     */
    public function setRows($startRow, $chunkSize)
    {
        $this->_startRow = $startRow;
        $this->_endRow = $startRow + $chunkSize;
    }

    /**
     * @param string $column
     * @param int $row
     * @param string $worksheetName
     * @return bool
     */
    public function readCell($column, $row, $worksheetName = '')
    {
        //  Only read the heading row, and the rows that are configured in $this->_startRow and $this->_endRow
        if (($row == 1) || ($row >= $this->_startRow && $row < $this->_endRow)) {
            return true;
        }
        return false;
    }
}


class MsieExcelReader extends MsieReader
{
    /** @var Spreadsheet $reader */
    public $reader = null;

    /**
     * MsieExcelReader constructor.
     * @param modX $modx
     * @param array $config
     */
    public function __construct(& $modx, $config=array())
    {

        parent::__construct($modx, $config);
    }

    public function read(array $provider, $callback = null)
    {

        if (!file_exists($provider['file'])) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, sprintf($this->modx->lexicon('msimportexport.err_nf_file'), $provider['file']));
            return false;
        }

        $this->provider = $provider;

        if (!isset($this->provider['seek'])) {
            $this->provider['seek'] = 0;
        }

        try {
            if ($this->initReader()) {
                $objSheet = $this->reader->getActiveSheet();
                $rowIterator = $objSheet->getRowIterator();
                $emptyValue = 0;
                $index = 1;

                if (isset($this->provider['seek']) && !empty($this->provider['seek'])) {
                    $index = $this->provider['seek'];
                    $rowIterator->resetStart($index);
                }

                while ($rowIterator->valid()) {
                    $cellIterator = $rowIterator->current()->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false);
                    $data = array();
                    while ($cellIterator->valid()) {
                        $val = $cellIterator->current()->getValue();
                        if (!empty($val)) $emptyValue++;
                        $data[] = $val;
                        $cellIterator->next();
                    }

                    $rowIterator->next();
                    $index++;

                    if (empty($emptyValue)) {
                        $this->setSeek(-1);
                    } else {
                        $this->setSeek($index);
                    }

                    if (is_callable($callback)) {
                        if (empty($emptyValue) || $callback($this, $data) !== true) {
                            unset($data);
                            unset($objSheet);
                            $this->disconnect();
                            return true;
                        }
                    }
                    $emptyValue = 0;
                }
                unset($data);
                unset($objSheet);
                $this->disconnect();
            }
        } catch (Exception $e) {
            if ($e->getLine() == 125 || $e->getLine() == 72 ) {
                $this->setSeek(-1);
                return true;
            }
            $this->modx->log(modX::LOG_LEVEL_ERROR, '[MsieExcelReader] Exception ' . $e->getMessage() . '. Info:' . print_r($e, 1));
            return false;
        }

        return true;
    }

    /**
     * @return int|null
     */
    public function getTotalRows()
    {
        return -1;
        if ($this->totalRows === null && !empty($this->provider)) {
            if ($this->initReader()) {
                $objSheet = $this->reader->getActiveSheet();
                $this->totalRows = $objSheet->getHighestRow();
            }
        }
        $this->disconnect();
        return $this->totalRows;
    }


    private function disconnect()
    {
        $this->reader->disconnectWorksheets();
        unset($this->reader);
    }

    /**
     * @return bool
     */
    private function initReader()
    {
        if (!$this->reader) {

            $chunkSize = (int)$this->modx->getOption('msimportexport.import.step_limit', null, 50);
            try {

                if ($cache = $this->getCacheAdapter()) {
                    Settings::setCache($cache);
                }

                $this->inputFileType = IOFactory::identify($this->provider['file']);
                $objReader = IOFactory::createReader($this->inputFileType);
                $objReader->setReadDataOnly(true);

                $readFilter = new ReadFilter();
                $readFilter->setRows((int)$this->provider['seek'], $chunkSize + 1);
                $objReader->setReadFilter($readFilter);
                $this->reader = $objReader->load($this->provider['file']);
                $this->reader->setActiveSheetIndex(0);

                unset($objReader);

            } catch (Exception $e) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, '[MsieExcelReader] Exception ' . $e->getMessage());
                return false;
            }
            return true;
        }
        return false;
    }

}
