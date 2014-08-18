<?php

require_once 'DataAccess.php';
require_once 'DBConnection.php';
require_once '../entity/Contact.php';
require_once '../entity/City.php';

/**
 * Data access management class for entity Contact.
 */
class ContactDataAccess extends DataAccess {

    /**
     * Initializes the database connection to be used for access the entity Contact.
     */
    public function __construct() {
        $this->conn = new DBConnection();
    }

    /**
     * Implements the SQL SELECT statement for the entity Contact.
     * @param integer $id
     * @return \Contact
     */
    public function select($id = null) {
        $this->conn->open();
        $query = "SELECT contact.id, firstName, lastName, street, zipCode, cityId, name FROM contact INNER JOIN city ON cityId = city.id WHERE contact.id=:id OR :id IS NULL";
        $stmt = $this->conn->getConnection()->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $contacts = array();
        foreach ($rows as $row) {
            $contact = new Contact();
            $contact->setId($row['id']);
            $contact->setFirstName($row['firstName']);
            $contact->setLastName($row['lastName']);
            $contact->setStreet($row['street']);
            $contact->setZipCode($row['zipCode']);
            $city = new City();
            $city->setId($row['cityId']);
            $city->setName($row['name']);
            $contact->setCity($city);
            $contacts[$contact->getId()] = $contact;
        }
        $this->conn->close();
        return $contacts;
    }

    /**
     * Implements the SQL INSERT statement for the entity Contact.
     * @param Entity $entity Contact
     * @return boolean
     */
    public function insert(Entity $entity) {
        $this->conn->open();
        $query = "INSERT INTO contact (firstName, lastName, street, zipCode, cityId) VALUES (:firstName, :lastName, :street, :zipCode, :cityId)";
        $stmt = $this->conn->getConnection()->prepare($query);
        $stmt->bindValue(':firstName', $entity->getFirstName(), PDO::PARAM_STR);
        $stmt->bindValue(':lastName', $entity->getLastName(), PDO::PARAM_STR);
        $stmt->bindValue(':street', $entity->getStreet(), PDO::PARAM_STR);
        $stmt->bindValue(':zipCode', $entity->getZipCode(), PDO::PARAM_STR);
        $stmt->bindValue(':cityId', $entity->getCity()->getId(), PDO::PARAM_STR);
        $stmt->execute();
        $affected_rows = $stmt->rowCount();
        $this->conn->close();
        return ($affected_rows > 0);
    }

    /**
     * Implements the SQL UPDATE statement for the entity Contact.
     * @param Entity $entity Contact
     * @return boolean
     */
    public function update(Entity $entity) {
        $this->conn->open();
        $query = "UPDATE contact SET firstName=:firstName, lastName=:lastName, street=:street, zipCode=:zipCode, cityId=:cityId WHERE id=:id";
        $stmt = $this->conn->getConnection()->prepare($query);
        $stmt->bindValue(':id', $entity->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':firstName', $entity->getFirstName(), PDO::PARAM_STR);
        $stmt->bindValue(':lastName', $entity->getLastName(), PDO::PARAM_STR);
        $stmt->bindValue(':street', $entity->getStreet(), PDO::PARAM_STR);
        $stmt->bindValue(':zipCode', $entity->getZipCode(), PDO::PARAM_STR);
        $stmt->bindValue(':cityId', $entity->getCity()->getId(), PDO::PARAM_INT);
        $stmt->execute();
        $affected_rows = $stmt->rowCount();
        $this->conn->close();
        return ($affected_rows > 0);
    }

    /**
     * Implements the SQL DELETE statement for the entity Contact.
     * @param integer $id
     * @return boolean
     */
    public function delete($id) {
        $this->conn->open();
        $query = "DELETE FROM contact WHERE id=:id";
        $stmt = $this->conn->getConnection()->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $affected_rows = $stmt->rowCount();
        $this->conn->close();
        return ($affected_rows > 0);
    }

}

?>