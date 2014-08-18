<?php

require_once '../entity/City.php';
require_once '../data/CityDataAccess.php';

/**
 * Controller class for City management.
 */
class CityManager {

    /**
     * Get the available city list.
     * @return City[]
     * @throws Exception
     */
    public static function getCityList() {
        $dataAccess = new CityDataAccess();
        try {
            $cities = $dataAccess->select();
            return $cities;
        } catch (Exception $ex) {
            throw new Exception('An error has occurred trying to get the list of cities from the database.');
        }
    }

    /**
     * Get a specific city.
     * @param string $id
     * @return City
     * @throws Exception
     */
    public static function getCity($id) {
        $dataAccess = new CityDataAccess();
        try {
            $cities = $dataAccess->select($id);
            return $cities[$id];
        } catch (Exception $ex) {
            throw new Exception('An error has occurred trying to get the city with ID: ' . $id . '.');
        }
    }

}

?>
