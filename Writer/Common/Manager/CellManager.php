<?php

namespace koolreport\Spout\Writer\Common\Manager;

use koolreport\Spout\Common\Entity\Cell;
use koolreport\Spout\Common\Entity\Style\Style;
use koolreport\Spout\Writer\Common\Manager\Style\StyleMerger;

class CellManager
{
    /**
     * @var StyleMerger
     */
    protected $styleMerger;

    /**
     * @param StyleMerger $styleMerger
     */
    public function __construct(StyleMerger $styleMerger)
    {
        $this->styleMerger = $styleMerger;
    }

    /**
     * Merges a Style into a cell's Style.
     *
     * @param Cell $cell
     * @param Style $style
     * @return void
     */
    public function applyStyle(Cell $cell, Style $style)
    {
        $mergedStyle = $this->styleMerger->merge($cell->getStyle(), $style);
        $cell->setStyle($mergedStyle);
    }
}
