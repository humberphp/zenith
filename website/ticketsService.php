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
    case 'getAllTickets':
	$response = supportTicketsDB::getAllTickets($departmentId);
        $result = array();   
        foreach ($response as $cont):
            $set = array("supportTicketId" => $cont['supportTicketId'],"senderUserId"=>$cont['senderUserId']
                ,"senderName" => $cont['senderName'], "Subject" => $cont['Subject']
                ,"submitDate"=>$cont['submitDate'],"response" => $cont['response']);         
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
    case 'saveReply':
        $response = supportTicketsDB::saveTicketReply($ticketId, $userId, $submitDate, $message, $isReplied);
        if($response)
        {
            $result = $response;
        }
        else 
            {
                $result = $response;
            }
        break;
    default:
        $result = "fail";            
}
echo json_encode($result);
?>