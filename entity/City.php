<?php

require_once 'Entity.php';

/**
 * Entity class that represents a city (database table: city).
 */
class City extends Entity {

    private $id;
    private $name;

    public function __construct() {
        $this->id = "";
        $this->name = "";
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

}

?>
