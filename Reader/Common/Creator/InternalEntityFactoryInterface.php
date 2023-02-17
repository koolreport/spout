<?php

namespace koolreport\Spout\Reader\Common\Creator;

use koolreport\Spout\Common\Entity\Cell;
use koolreport\Spout\Common\Entity\Row;

/**
 * Interface EntityFactoryInterface
 */
interface InternalEntityFactoryInterface
{
    /**
     * @param Cell[] $cells
     * @return Row
     */
    public function createRow(array $cells = []);

    /**
     * @param mixed $cellValue
     * @return Cell
     */
    public function createCell($cellValue);
}
