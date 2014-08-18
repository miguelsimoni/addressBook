<?php

require_once '../controller/ContactManager.php';

if (isset($_GET['from'])) {
    switch ($_GET['from']) {
        case 'XML': //ImportManager.php?from=XML
            ImportManager::fromXML();
            break;
    }
}

/**
 * Controller class for Export management.
 */
class ImportManager {

    /**
     * Import Contact list from XML.
     */
    public static function fromXML() {
        $xmlReader = new XMLReader();
        
        $file = isset($_FILES('file'));
        $xmlReader->open($file);
        while ($xmlReader->read()) {
            if ('product' === $xmlReader->name) {
                printf('<hr>%3$s ist ein %1$s und hat eine Steuer von %2$d<br>', $xmlReader->name, $xmlReader->getAttribute('tax'), $xmlReader->getAttribute('name'));
                $xmlReader->next();
            }
        }
    }

}

?>
