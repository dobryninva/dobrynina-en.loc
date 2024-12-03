<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Shared\File;
use PhpOffice\PhpSpreadsheet\Collection\CellsFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\DataType;


class MsieExcelWriter extends MsieWriter
{
    /** @var Spreadsheet $writer */
    private $writer = null;
    private $title = '';
    private $date = '';
    public $sheet = null;

    /**
     * MsieExcelWriter constructor.
     * @param modX $modx
     * @param array $config
     */
    public function __construct(& $modx, $config = array())
    {
        parent::__construct($modx, $config);
        $this->seek = 1;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        $this->writer->getProperties()->setTitle($this->title)->setSubject($this->title);
    }

    public function save($filename = '', $path = '')
    {

        $filename = empty($filename) ? 'export_' . date('d_m_Y_H_i_s') . '.xlsx' : $filename;
        if (!$this->writer) $this->initWrite();
        $objWriter = IOFactory::createWriter($this->writer, 'Xlsx');
        if (empty($path)) {
            // Redirect output to a client’s web browser (Xlsx)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $objWriter->save('php://output');
        } else {
            $objWriter->save($path . $filename);
        }
        $this->writer->disconnectWorksheets();
        unset($objWriter);
        unset($this->sheet);
        unset($this->writer);
    }

    public function write(array $data, array $options = array())
    {
        $this->initWrite();
        $index = 1;
        $options = array_merge(
            array(
                'mergeCells' => array('columnIndex1' => 0, 'row1' => 0, 'columnIndex2' => null, 'row2' => null),
                'style' => array(),
                'drawing' => array(),
                'autoSize' => $this->modx->getOption('msieimport.export.column_auto_size', null, 0, true),
            ),
            $options
        );
        $mergeCells = $options['mergeCells'];
        foreach ($data as $k => $v) {
            if ($v !== null) {
                $this->sheet->setCellValueByColumnAndRow($index, $this->seek, $v);
                if (!empty($options['style'])) {
                    $this->sheet->getStyleByColumnAndRow($index, $this->seek)->applyFromArray($options['style']);
                }
            }
            if (!empty($mergeCells['columnIndex1'])) {
                if (empty($mergeCells['row1'])) {
                    $mergeCells['row1'] = $this->seek;

                }
                if (empty($mergeCells['row2'])) {
                    $mergeCells['row2'] = $this->seek;
                }
                $this->sheet->mergeCellsByColumnAndRow(
                    $mergeCells['columnIndex1'],
                    $mergeCells['row1'],
                    $mergeCells['columnIndex2'],
                    $mergeCells['row2']
                );
            }
            //$сell = $this->sheet->setCellValueByColumnAndRow($index, $this->seek, $v, true);
            /*else {
                $сell->setValueExplicit($v, DataType::TYPE_STRING);
            }*/
            if ($options['autoSize']) {
                $this->sheet->getColumnDimensionByColumn($k)->setAutoSize(true);
            }
            $index++;
        }
        $this->seek++;
        return true;
    }

    public function drawing($file, $columnIndex, $row, $options = array())
    {
        $this->initWrite();
        $coordinates = $this->sheet->getCellByColumnAndRow($columnIndex, $row)->getCoordinate();
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setPath($file);
        $drawing->setCoordinates($coordinates);
        $drawing->setResizeProportional(true);
        $drawing->setOffsetX(5);
        $drawing->setOffsetY(5);
        if (isset($options['width'])) {
            $drawing->setWidth($options['width']);
        }
        if (isset($options['height'])) {
            $drawing->setHeight($options['height']);
        }
        $this->sheet->getColumnDimensionByColumn($columnIndex)->setWidth(($drawing->getWidth() + 20) * 0.125);
        $this->sheet->getRowDimension($row)->setRowHeight(($drawing->getHeight() + 10) - ($drawing->getHeight() * 0.25));
        $drawing->setWorksheet($this->sheet);
        unset($drawing);
    }

    public function initWrite()
    {
        if (!$this->writer) {
            $this->date = date('d-m-Y H:i:s');
            $this->title = 'miniShop2 export ' . $this->date;
            File::setUseUploadTempDirectory(true);

            if ($cache = $this->getCacheAdapter()) {
                Settings::setCache($cache);
            }

            $this->writer = new Spreadsheet();
            $this->writer->getProperties()->setTitle($this->title)->setSubject($this->title);
            $this->writer->getDefaultStyle()->getFont()->setName('Arial');
            $this->writer->getDefaultStyle()->getFont()->setSize(10);
            $this->writer->getDefaultStyle()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            $this->writer->getDefaultStyle()->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
            $this->writer->setActiveSheetIndex(0);
            $this->sheet = $this->writer->getActiveSheet();
            $this->sheet->setTitle('Export');
        }
    }
}
