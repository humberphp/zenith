<?php
require_once '../Database.php';
require_once '../membershipPlansDB.php';

extract($_REQUEST);

$response;
$result;
switch ($data)
{
    case 'updPlan':
        $result = membershipPlansDB::updateMembership($membershipId, $membership, $daysAllowed, $contactsAllowed, $price, $comments);      
        break;
    case 'svPlan':
        $result = membershipPlansDB::saveMembership($membership, $daysAllowed, $contactsAllowed, $price, $comments);
        break;
    case 'delPlan':
        $result = membershipPlansDB::deleteMembershipPlan($planId);      
        break;
    default:
        $result = "fail";            
}
echo json_encode($result);
?>