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
    public static function getStates($countryId){    
        $conn = Database::getDB(); 
        $sql = "CALL spGetStates(:Country)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('Country', $countryId, PDO::PARAM_INT, 11);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    public static function getCities($stateId){    
        $conn = Database::getDB(); 
        $sql = "CALL spGetCities(:state)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('state', $stateId, PDO::PARAM_INT, 11);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
}
