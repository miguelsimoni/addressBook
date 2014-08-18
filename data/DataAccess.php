<?php

/**
 * Abstract base class for all database access classes of the application.
 */
abstract class DataAccess {

    protected $conn; //DBConnection object to connect to the database.

    /**
     * To implement the SQL SELECT statement for the specific entity (table).
     */
    public abstract function select($id = null);
    
    /**
     * To implement the SQL INSERT statement for the specific entity (table).
     */
    public abstract function insert(Entity $entity);
    
    /**
     * To implement the SQL UPDATE statement for the specific entity (table).
     */
    public abstract function update(Entity $entity);
    
    /**
     * To implement the SQL DELETE statement for the specific entity (table).
     */
    public abstract function delete($id);
    
}

?>
