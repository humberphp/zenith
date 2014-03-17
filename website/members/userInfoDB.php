<?php
require_once '../Database.php';

class userInfoDB{
        
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
    
    public function updateUserBasicInfo($bodyType, $complexion, $physicalStatus, $height, $weight
            , $motherTounge, $martialStatus, $drinkHabits, $smokeHabits, $eatingHabits, $hairColor)
    {
        $conn = Database::getDB(); 
        $sql = "CALL spUpdateUserBasicInfo(:UsersId, :bodyTypes, :complexions, :physicalStatuss, :heights"
                . ", :weights, :motherTounges, :martialStatuss, :drinkHabitss, :smokeHabitss, :eatingHabitss, :hairColors)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('UsersId', $_SESSION['loginUserId'], PDO::PARAM_INT, 11);
        $stmt->bindParam('bodyTypes', $bodyType, PDO::PARAM_STR, 50);
        $stmt->bindParam('complexions', $complexion, PDO::PARAM_STR, 50);
        $stmt->bindParam('physicalStatuss', $physicalStatus, PDO::PARAM_STR, 50);
        $stmt->bindValue('heights', $height);
        $stmt->bindValue('weights', $weight);
        $stmt->bindParam('motherTounges', $motherTounge, PDO::PARAM_STR, 50);
        $stmt->bindParam('martialStatuss', $martialStatus, PDO::PARAM_STR, 50);
        $stmt->bindParam('drinkHabitss', $drinkHabits, PDO::PARAM_STR, 50);
        $stmt->bindParam('smokeHabitss', $smokeHabits, PDO::PARAM_STR, 50);
        $stmt->bindParam('eatingHabitss', $eatingHabits, PDO::PARAM_STR, 50);
        $stmt->bindParam('hairColors', $hairColor, PDO::PARAM_STR, 50);
        $row_count = $stmt->execute();
        $stmt->closeCursor();
        return $row_count;
    }
    
}
?>
