<?php
require_once '../Database.php';
require_once '../membershipPlansDB.php';

extract($_REQUEST);

$response;
$result;
switch ($data)
{
    case 'updPlan':
        $response = membershipPlansDB::updateMembership($membershipId, $membership, $daysAllowed, $contactsAllowed, $price, $comments);
        if($response)
        {
            $result = $response;
        }
        else 
            {
                $result = $response;
            }
        break;
    case 'svPlan':
        $result = membershipPlansDB::saveMembership($membership, $daysAllowed, $contactsAllowed, $price, $comments);
        break;
    default:
        $result = "fail";            
}
echo json_encode($result);
?>