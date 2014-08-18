<?php

require_once '../entity/Contact.php';
require_once '../data/ContactDataAccess.php';

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'save': //ContactManager.php?action=save
            ContactManager::save();
            break;
        case 'delete': //ContactManager.php?action=delete&id=##
            ContactManager::delete();
            break;
    }
}

/**
 * Controller class for Contact management.
 */
class ContactManager {

    /*
     * Get the available contact list.
     * @return Contact[]
     * @throws Exception
     */
    public static function getContactList() {
        $dataAccess = new ContactDataAccess();
        try {
            $contacts = $dataAccess->select();
            return $contacts;
        } catch (Exception $ex) {
            throw new Exception('An error has occurred trying to get the list of contacts from the database.');
        }
    }

    /**
     * Get a specific contact.
     * @param integer $id
     * @return Contact
     * @throws Exception
     */
    public static function getContact($id) {
        $dataAccess = new ContactDataAccess();
        try {
            $contacts = $dataAccess->select($id);
            return $contacts[$id];
        } catch (Exception $ex) {
            throw new Exception('An error has occurred trying to get the contact with ID: ' . $id . '.');
        }
    }

    /**
     * Save a contact.
     * Update an existing contact (with the given ID), or create a new one (if ID is equals to zero).
     * @throws Exception
     */
    public static function save() {
        $contact = new Contact();
        $contact->setId($_POST['id']);
        $contact->setFirstName($_POST['firstName']);
        $contact->setLastName($_POST['lastName']);
        $contact->setStreet($_POST['street']);
        $contact->setZipCode($_POST['zipCode']);
        $city = new City();
        $city->setId($_POST['city']);
        $contact->setCity($city);

        $dataAccess = new ContactDataAccess();
        try {
            if ($contact->getId() == 0) {
                $dataAccess->insert($contact);
            } else {
                $dataAccess->update($contact);
            }
        } catch (Exception $ex) {
            throw new Exception('An error has occurred trying to save the contact.');
        }

        echo "Contact ID " . $contact->getId() . " saved.";

        header('location: ../view/list.php');
    }

    /*
     * Delete an existing contact with the given ID.
     * @throws Exception
     */
    public static function delete() {
        $id = $_GET['id'];

        $dataAccess = new ContactDataAccess();
        try {
            $dataAccess->delete($id);
        } catch (Exception $ex) {
            throw new Exception('An error has occurred trying to delete the contact with ID: ' . $id . '.');
        }

        echo "Contact ID " . $id . " deleted.";

        header('location: ../view/list.php');
    }

}

?>