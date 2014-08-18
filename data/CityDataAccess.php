<?php

require_once 'DataAccess.php';
require_once 'DBConnection.php';

/**
 * Data access management class for entity City.
 */
class CityDataAccess extends DataAccess {

    /**
     * Initializes the database connection to be used for access the entity City.
     */
    public function __construct() {
        $this->conn = new DBConnection();
    }

    /**
     * Implements the SQL SELECT statement for the entity City.
     * @param string $id
     * @return \City
     */
    public function select($id = null) {
        $this->conn->open();
        $query = "SELECT id, name FROM city WHERE id=:id OR :id IS NULL";
        $stmt = $this->conn->getConnection()->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $cities = array();
        foreach ($rows as $row) {
            $city = new City();
            $city->setId($row['id']);
            $city->setName($row['name']);
            $cities[$city->getId()] = $city;
        }
        $this->conn->close();
        return $cities;
    }

    /**
     * Implements the SQL INSERT statement for the entity City.
     * @param Entity $entity City
     * @return boolean
     */
    public function insert(Entity $entity) {
        $this->conn->open();
        $query = "INSERT INTO city (id, name) VALUES (:id, :name)";
        $stmt = $this->conn->getConnection()->prepare($query);
        $stmt->bindValue(':id', $entity->getId(), PDO::PARAM_STR);
        $stmt->bindValue(':name', $entity->getName(), PDO::PARAM_STR);
        $stmt->execute();
        $affected_rows = $stmt->rowCount();
        $this->conn->close();
        return ($affected_rows > 0);
    }

    /**
     * Implements the SQL UPDATE statement for the entity City.
     * @param Entity $entity City
     * @return boolean
     */
    public function update(Entity $entity) {
        $this->conn->open();
        $query = "UPDATE city SET name=:name WHERE id=:id";
        $stmt = $this->conn->getConnection()->prepare($query);
        $stmt->bindValue(':id', $entity->getId(), PDO::PARAM_STR);
        $stmt->bindValue(':name', $entity->getName(), PDO::PARAM_STR);
        $stmt->execute();
        $affected_rows = $stmt->rowCount();
        $this->conn->close();
        return ($affected_rows > 0);
    }

    /**
     * Implements the SQL DELETE statement for the entity City.
     * @param string $id
     * @return boolean
     */
    public function delete($id) {
        $this->conn->open();
        $query = "DELETE FROM city WHERE id=:id";
        $stmt = $this->conn->getConnection()->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $affected_rows = $stmt->rowCount();
        $this->conn->close();
        return ($affected_rows > 0);
    }

}

?>