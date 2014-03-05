<?php

class UserInfoDB{
    public function getUserDetailsById($userId){    
        $conn = Database::getDB(); 
        $sql = "{:retval = CALL spGetUserDetailsById(?)}";
        $stmt = $conn->prepare($sql);
       $stmt->bindValue('UsersId', $userId, PDO::PARAM_INT);
        $row = $stmt->execute();
        return $row;
    }
}
?>
