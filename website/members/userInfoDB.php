<?php
require_once '../Database.php';

class userInfoDB{
    
    public static function getUserDefaultThumb($userId){    
        $conn = Database::getDB(); 
        $sql = "CALL spGetUserDefaultThumb(:UsersId)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('UsersId', $userId, PDO::PARAM_INT, 11);
//        $stmt->bindParam(1, $second_name, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 32);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    public static function getUserNameAddress($userId){    
        $conn = Database::getDB(); 
        $sql = "CALL spGetUserNameAddress(:UsersId)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('UsersId', $userId, PDO::PARAM_INT, 11);
//        $stmt->bindParam(1, $second_name, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 32);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    public function getUserDetailsById($userId){    
        $conn = Database::getDB(); 
        $sql = "CALL spGetUserDetailsById(:UsersId)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('UsersId', $userId, PDO::PARAM_INT, 11);
//        $stmt->bindParam(1, $second_name, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 32);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    public function getUserFamilyDetails($userId){         
        $conn = Database::getDB(); 
        $sql = "CALL spGetUserFamilyDetails(:UsersId)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('UsersId', $userId, PDO::PARAM_INT, 11);
//        $stmt->bindParam(1, $second_name, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 32);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    public function getUserHobbies($userId){         
        $conn = Database::getDB(); 
        $sql = "CALL spGetUserHobbies(:UsersId)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('UsersId', $userId, PDO::PARAM_INT, 11);
//        $stmt->bindParam(1, $second_name, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 32);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    public function getUserLocation($userId){         
        $conn = Database::getDB(); 
        $sql = "CALL spGetUserLocation(:UsersId)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('UsersId', $userId, PDO::PARAM_INT, 11);
//        $stmt->bindParam(1, $second_name, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 32);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    public function getUserPartnerPref($userId){         
        $conn = Database::getDB(); 
        $sql = "CALL spGetUserPartnerPref(:UsersId)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('UsersId', $userId, PDO::PARAM_INT, 11);
//        $stmt->bindParam(1, $second_name, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 32);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    public function getUserProfession($userId){         
        $conn = Database::getDB(); 
        $sql = "CALL getUserProfession(:UsersId)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('UsersId', $userId, PDO::PARAM_INT, 11);
//        $stmt->bindParam(1, $second_name, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 32);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
}
?>
