<?php

namespace koolreport\Spout\Writer\XLSX\Creator;

use koolreport\Spout\Common\Helper\Escaper;
use koolreport\Spout\Common\Helper\StringHelper;
use koolreport\Spout\Common\Manager\OptionsManagerInterface;
use koolreport\Spout\Writer\Common\Creator\InternalEntityFactory;
use koolreport\Spout\Writer\Common\Entity\Options;
use koolreport\Spout\Writer\Common\Helper\ZipHelper;
use koolreport\Spout\Writer\XLSX\Helper\FileSystemHelper;

/**
 * Class HelperFactory
 * Factory for helpers needed by the XLSX Writer
 */
class HelperFactory extends \koolreport\Spout\Common\Creator\HelperFactory
{
    /**
     * @param OptionsManagerInterface $optionsManager
     * @param InternalEntityFactory $entityFactory
     * @return FileSystemHelper
     */
    public function createSpecificFileSystemHelper(OptionsManagerInterface $optionsManager, InternalEntityFactory $entityFactory)
    {
        $tempFolder = $optionsManager->getOption(Options::TEMP_FOLDER);
        $zipHelper = $this->createZipHelper($entityFactory);
        $escaper = $this->createStringsEscaper();

        return new FileSystemHelper($tempFolder, $zipHelper, $escaper);
    }

    /**
     * @param InternalEntityFactory $entityFactory
     * @return ZipHelper
     */
    private function createZipHelper(InternalEntityFactory $entityFactory)
    {
        return new ZipHelper($entityFactory);
    }

    /**
     * @return Escaper\XLSX
     */
    public function createStringsEscaper()
    {
        return new Escaper\XLSX();
    }

    /**
     * @return StringHelper
     */
    public function createStringHelper()
    {
        return new StringHelper();
    }
}
