<?php

require_once '../controller/ContactManager.php';

if (isset($_GET['to'])) {
    switch ($_GET['to']) {
        case 'XML': //ExportManager.php?to=XML
            ExportManager::toXML();
            break;
    }
}

/**
 * Controller class for Export management.
 */
class ExportManager {

    /**
     * Export Contact list to XML.
     */
    public static function toXML() {
        //set file parameters to download.
        header('content-type: text/xml;');
        header('content-disposition: attachment; filename="addressBook.xml"');

        $xmlWriter = new XMLWriter();
        $xmlWriter->openMemory();
        $xmlWriter->startDocument('1.0', 'UTF-8');

        $xmlWriter->startElement('addressBook');
        try {
            $contacts = ContactManager::getContactList();
        } catch (Exception $ex) {
        }
        if (isset($contacts)) {
            foreach ($contacts as $contact) {
                $xmlWriter->startElement('Contact');
                $xmlWriter->startAttribute('ID');
                $xmlWriter->text($contact->getId());
                $xmlWriter->endAttribute();

                $xmlWriter->startElement('FirstName');
                $xmlWriter->text($contact->getFirstName());
                $xmlWriter->endElement();

                $xmlWriter->startElement('LastName');
                $xmlWriter->text($contact->getLastName());
                $xmlWriter->endElement();

                $xmlWriter->startElement('Street');
                $xmlWriter->text($contact->getStreet());
                $xmlWriter->endElement();

                $xmlWriter->startElement('ZipCode');
                $xmlWriter->text($contact->getZipCode());
                $xmlWriter->endElement();

                $xmlWriter->startElement('City');
                $xmlWriter->startAttribute('ID');
                $xmlWriter->text($contact->getCity()->getId());
                $xmlWriter->endAttribute();
                $xmlWriter->text($contact->getCity()->getName());
                $xmlWriter->endElement();

                $xmlWriter->endElement();
            }
        }
        $xmlWriter->endElement();

        $xmlWriter->endDocument();
        echo $xmlWriter->outputMemory(TRUE);
    }

}

?>
