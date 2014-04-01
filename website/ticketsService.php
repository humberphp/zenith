<?php
require_once 'Database.php';
require_once 'supportTicketsDB.php';

extract($_REQUEST);

$response;
$result;
switch ($data)
{
    case 'getDepartments':
	$response = supportTicketsDB::getDepartments();
        $result = array();   
        foreach ($response as $cont):
            $set = array("departmentId" => $cont['DepartmentId'],"department"=>$cont['Department']);         
            $result[]=$set;
        endforeach;
        break;
    case 'closeT':
        $response = supportTicketsDB::closeTicket($tId);
        if($response)
        {
            $result = true;
        }
        else 
            {
                $result = false;
            }
        break;
    case 'saveTicket':
        $result = supportTicketsDB::saveNewTicket($userId, $subject, $submitDate, $departmentId, $message);
        break;
    default:
        $result = "fail";            
}
echo json_encode($result);
?>