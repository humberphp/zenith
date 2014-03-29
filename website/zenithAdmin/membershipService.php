<?php
require_once '../Database.php';
require_once '../membershipPlansDB.php';

extract($_REQUEST);

$response;
$result;
switch ($data)
{
    case 'getAllMembershipPlans':
	$response = commonDB::getContactDetails($uid, $contId);
        $result = array();   
        foreach ($response as $cont):
            $set = array("email" => $cont['email'],"phone"=>$cont['phone']);         
            $result[]=$set;
        endforeach;
        break;
    default:
        $result = "fail";            
}
echo json_encode($result);
?>