<?php

namespace koolreport\Spout\Reader\CSV\Creator;

use koolreport\Spout\Common\Creator\HelperFactory;
use koolreport\Spout\Common\Entity\Cell;
use koolreport\Spout\Common\Entity\Row;
use koolreport\Spout\Common\Helper\GlobalFunctionsHelper;
use koolreport\Spout\Common\Manager\OptionsManagerInterface;
use koolreport\Spout\Reader\Common\Creator\InternalEntityFactoryInterface;
use koolreport\Spout\Reader\CSV\RowIterator;
use koolreport\Spout\Reader\CSV\Sheet;
use koolreport\Spout\Reader\CSV\SheetIterator;

/**
 * Class EntityFactory
 * Factory to create entities
 */
class InternalEntityFactory implements InternalEntityFactoryInterface
{
    /** @var HelperFactory */
    private $helperFactory;

    /**
     * @param HelperFactory $helperFactory
     */
    public function __construct(HelperFactory $helperFactory)
    {
        $this->helperFactory = $helperFactory;
    }

    /**
     * @param resource $filePointer Pointer to the CSV file to read
     * @param OptionsManagerInterface $optionsManager
     * @param GlobalFunctionsHelper $globalFunctionsHelper
     * @return SheetIterator
     */
    public function createSheetIterator($filePointer, $optionsManager, $globalFunctionsHelper)
    {
        $rowIterator = $this->createRowIterator($filePointer, $optionsManager, $globalFunctionsHelper);
        $sheet = $this->createSheet($rowIterator);

        return new SheetIterator($sheet);
    }

    /**
     * @param RowIterator $rowIterator
     * @return Sheet
     */
    private function createSheet($rowIterator)
    {
        return new Sheet($rowIterator);
    }

    /**
     * @param resource $filePointer Pointer to the CSV file to read
     * @param OptionsManagerInterface $optionsManager
     * @param GlobalFunctionsHelper $globalFunctionsHelper
     * @return RowIterator
     */
    private function createRowIterator($filePointer, $optionsManager, $globalFunctionsHelper)
    {
        $encodingHelper = $this->helperFactory->createEncodingHelper($globalFunctionsHelper);

        return new RowIterator($filePointer, $optionsManager, $encodingHelper, $this, $globalFunctionsHelper);
    }

    /**
     * @param Cell[] $cells
     * @return Row
     */
    public function createRow(array $cells = [])
    {
        return new Row($cells, null);
    }

    /**
     * @param mixed $cellValue
     * @return Cell
     */
    public function createCell($cellValue)
    {
        return new Cell($cellValue);
    }

    /**
     * @param array $cellValues
     * @return Row
     */
    public function createRowFromArray(array $cellValues = [])
    {
        $cells = \array_map(function ($cellValue) {
            return $this->createCell($cellValue);
        }, $cellValues);

        return $this->createRow($cells);
    }
}
