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
        if((int)$response > 0)
        {
            $email = supportTicketsDB::getUserEmailByTicketId($ticketId);
            include_once '../emails.php';
            foreach($email as $em):
                $emAdd = $em['email'];
                $name = $em['Name'];
                $subject = "RE: Ticket [Ticket ID: " . $result . "]";
                $body = "<h3>Dear " . $name . "</h3>";
                $body .= "Your ticket [Ticket ID: " . $ticketId . '] is closed.<br /><br />' ;
                $body .= "We hope you are satisfied with our services. <br />";
                $body .= "Team Zenith";                
            endforeach;
        }
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
        if((int)$result > 0)
        {
            $email = supportTicketsDB::getUserEmailByUserId($userId);
            include_once '../emails.php';
            foreach($email as $em):
                $emAdd = $em['email'];
                $name = $em['Name'];
                $subject = "Ticket [Ticket ID: " . $result . "]";
                $body = "<h3>Dear " . $name . "</h3>";
                $body .= "Your ticket regarding " . $subject . "has been submited successfully.<br />";
                $body .= "Please login into your account to track status and response from us.<br />";
                $body .= "Team Zenith";                
            endforeach;
        }
        break;
    case 'saveReply':
        $response = supportTicketsDB::saveTicketReply($ticketId, $userId, $submitDate, $message, $isReplied);
        if((int)$response > 0)
        {
            $email = supportTicketsDB::getUserEmailByTicketId($ticketId);
            include_once '../emails.php';
            foreach($email as $em):
                $emAdd = $em['email'];
                $name = $em['Name'];
                $subject = "RE: Ticket [Ticket ID: " . $result . "]";
                $body = "<h3>Dear " . $name . "</h3>";
                $body .= "Your ticket [Ticket ID: " . $ticketId . '] is updated.' ;
                $body .= "<br />";
                $body .= "Please login into your account to track status and response <br />";
                $body .= "Team Zenith";                
            endforeach;
        }
        if($response)
        {
            $result = true;
        }
        else 
            {
                $result = false;
            }
        break;
    default:
        $result = "fail";            
}
echo json_encode($result);
?>