<?php
require_once 'Database.php';
require_once 'supportTicketsDB.php';
require_once 'emails.php';
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
            foreach($email as $em):
                $toAdd = $em['Name'] . ' <' . $em['email'] . '>';
                $name = $em['Name'];
                $subject = "RE: Ticket [Ticket ID: {$result}]";
                $emailbody = "<h3>Dear " . $name . "</h3>";
                $emailbody .= "Your ticket [Ticket ID: {$ticketId}] is closed.<br /><br />" ;
                $emailbody .= "We hope you are satisfied with our services. <br />";
                $emailbody .= "Team Zenith";     
                
                $emailObj = new emails();
                $emailObj->send_email($toAdd, $subject, $emailbody, true);                 
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
            foreach($email as $em):
                $toAdd = $em['Name'] . ' <' . $em['email'] . '>';
                $name = $em['Name'];
                $subject = "Ticket [Ticket ID:  {$result}]";
                $emailbody = "<h3>Dear {$name}</h3>";
                $emailbody .= "Your ticket regarding {$subject} has been submited successfully.<br />";
                $emailbody .= "Please login into your account to track status and response from us.<br />";
                $emailbody .= "Team Zenith";        
                
                $emailObj = new emails();
                $emailObj->send_email($toAdd, $subject, $emailbody, true);              
            endforeach;
        }
        break;
    case 'saveReply':
        $response = supportTicketsDB::saveTicketReply($ticketId, $userId, $submitDate, $message, $isReplied);
        if((int)$response > 0)
        {
            $email = supportTicketsDB::getUserEmailByTicketId($ticketId);
            foreach($email as $em):
                $toAdd = $em['Name'] . ' <' . $em['email'] . '>';
                $name = $em['Name'];
                $subject = "RE: Ticket [Ticket ID:  {$result}]";
                $emailbody = "<h3>Dear " . $name . "</h3>";
                $emailbody .= "Your ticket [Ticket ID: {$ticketId}] is updated." ;
                $emailbody .= "<br />";
                $emailbody .= "Please login into your account to track status and response <br />";
                $emailbody .= "Team Zenith";                
                
                $emailObj = new emails();
                $emailObj->send_email($toAdd, $subject, $emailbody, true);      
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