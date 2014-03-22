<?php
require_once 'Database.php';
class commonDB {
    public static function getCountries(){    
        $conn = Database::getDB(); 
        $sql = "CALL spGetCountries()";
        $stmt = $conn->prepare($sql);
        //$stmt->bindParam('UsersId', $userId, PDO::PARAM_INT, 11);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    public static function getStates($countryName){    
        $conn = Database::getDB(); 
        $sql = "CALL spGetStates(:Country)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('Country', $countryName, PDO::PARAM_STR, 45);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    public static function getCities($stateName){    
        $conn = Database::getDB(); 
        $sql = "CALL spGetCities(:stateName)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('stateName', $stateName, PDO::PARAM_STR, 45);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
}
