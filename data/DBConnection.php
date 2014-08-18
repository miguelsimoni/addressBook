<?php

/**
 * Database connection class.
 */
class DBConnection {

    private $host;
    private $username;
    private $password;
    private $dbname;
    private $connection; //link to the database.

    public function __construct() {
        $this->host = "localhost";
        $this->username = "root";
        $this->password = "mysqladmin";
        $this->dbname = "addressBook";
    }

    function __destruct() {
        $this->close();
    }

    /**
     * Get the current open database connection.
     * @return PDO
     */
    public function getConnection() {
        return $this->connection;
    }

    /**
     * Open a database connection.
     */
    public function open() {
        $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8', $this->username, $this->password);
        if ($this->connection != null) {
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    /**
     * Close the database connection.
     */
    public function close() {
        $this->connection = null;
    }

}

?>