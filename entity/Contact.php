<?php

require_once 'Entity.php';

/**
 * Entity class that represents a contact (database table: contact).
 */
class Contact extends Entity {

    private $id;
    private $firstName;
    private $lastName;
    private $street;
    private $zipCode;
    private $city; //represents an entity City.

    public function __construct() {
        $this->id = 0;
        $this->firstName = "";
        $this->lastName = "";
        $this->street = "";
        $this->zipCode = "";
        $this->city = new City();
        $this->city->setId("");
        $this->city->setName("");
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getStreet() {
        return $this->street;
    }

    public function setStreet($street) {
        $this->street = $street;
    }

    public function getZipCode() {
        return $this->zipCode;
    }

    public function setZipCode($zipCode) {
        $this->zipCode = $zipCode;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

}

?>