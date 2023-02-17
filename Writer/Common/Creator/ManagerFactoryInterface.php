<?php

namespace koolreport\Spout\Writer\Common\Creator;

use koolreport\Spout\Common\Manager\OptionsManagerInterface;
use koolreport\Spout\Writer\Common\Manager\SheetManager;
use koolreport\Spout\Writer\Common\Manager\WorkbookManagerInterface;

/**
 * Interface ManagerFactoryInterface
 */
interface ManagerFactoryInterface
{
    /**
     * @param OptionsManagerInterface $optionsManager
     * @return WorkbookManagerInterface
     */
    public function createWorkbookManager(OptionsManagerInterface $optionsManager);

    /**
     * @return SheetManager
     */
    public function createSheetManager();
}
