<?php
/**
 * Description of membershipPlansDB
 *
 * @author Jagsir Singh
 */
include_once 'Database.php';

class membershipPlansDB {
    
    public function getMembershipPlans(){    
        $conn = Database::getDB(); 
        $sql = "CALL spGetMembershipPlans()";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    public static function updateMembership($membershipId, $membership, $daysAllowed, $contactsAllowed, $price, $comments){
        $conn = Database::getDB(); 
        $sql = "CALL spUpdateMembershipPlan(:memId, :memTitle, :days, :contacts, :totalPrice, :cmnts)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('memId', $membershipId, PDO::PARAM_INT, 11);
        $stmt->bindParam('memTitle', $membership, PDO::PARAM_STR, 50);
        $stmt->bindParam('days', $daysAllowed, PDO::PARAM_INT, 11);
        $stmt->bindParam('contacts', $contactsAllowed, PDO::PARAM_INT, 11);
        $stmt->bindValue('totalPrice', $price);
        $stmt->bindParam('cmnts', $comments, PDO::PARAM_STR, 500);
        $row_count = $stmt->execute();
        $stmt->closeCursor();
        return $row_count;
    }
    
    public static function saveMembership($membership, $daysAllowed, $contactsAllowed, $price, $comments){
        $conn = Database::getDB(); 
        $sql = "INSERT INTO tbl_memberships(membership, daysAllowed, contactsAllowed, price, comments)"
                . "VALUES(:memTitle, :days, :contacts, :totalPrice, :cmnts)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('memTitle', $membership, PDO::PARAM_STR, 50);
        $stmt->bindParam('days', $daysAllowed, PDO::PARAM_INT, 11);
        $stmt->bindParam('contacts', $contactsAllowed, PDO::PARAM_INT, 11);
        $stmt->bindValue('totalPrice', $price);
        $stmt->bindParam('cmnts', $comments, PDO::PARAM_STR, 500);
        $row_count = $stmt->execute();
        $stmt->closeCursor();
        $lastMemId = $conn->lastInsertId();
        return $lastMemId;
    }
}
