<?php
    // put your code here
    session_start();    
    include_once 'memberMasterPage.php';
    include_once '../membershipPlansDB.php';
//    require_once '../userInfoDB.php';
//    require_once '../commonDB.php';
    
    
    
    if(!isset($_SESSION['loginUserId']) || empty($_SESSION['loginUserId'])){
            header( 'Location: ../index.php' ) ;
        }
 
        
        // ==================================== THIS CODE IS MUST  (START) ==============================================
        $objPage = new memberMasterPage($_SESSION['loginUserId']);       // THIS INFORMATION COMES FROM SESSIONS ONCE USER LOGS IN;
        $objPage->setTitle('Zenith - Profile'); 
        $objPage->setMetaAuthor('this is meta author');
        // ==================================== THIS CODE IS MUST  (END) ==============================================
        $objMem = new membershipPlansDB();
        $allPlans = $objMem->getMembershipPlans();
        $body = "<form class='form-horizontal' method='post'>";
        $body .= "<br/><h3>Membership Plans</h4><br/>";
        foreach($allPlans as $plan):
            $membId = $plan['membershipId'];
            $title = $plan['membership'];
            $days = $plan['daysAllowed'];
            $price = "$" . $plan['price'] . " CA";
            $contactsAllowed = $plan['contactsAllowed'];
            $comments = $plan['comments'];
            //$body .= "<form method='POST' id='frmMemPlans'  action='subscribe.php'>";
                $body .= "<div  class='form-group'>";
                    $body .= "<div class='col-md-12'><h4><strong>{$title}</strong></h4></div>";
                    $body .= "<div class='col-md-2'><strong>Days:</strong></div>";
                    $body .= "<div class='col-md-1'>";
                        $body .= "{$days}";
                    $body .= "</div>";
                    $body .= "<div class='col-md-3'><strong>Contacts:</strong></div>";
                    $body .= "<div class='col-md-1'>";
                        $body .= "{$contactsAllowed}";
                    $body .= "</div>";
                    $body .= "<div class='col-md-2'><strong>Price:</strong></div>";
                    $body .= "<div class='col-md-3'>";
                        $body .= "{$price}";
                    $body .= "</div>";
                    $body .= "<div class='col-md-12'><strong>Comments:</strong> {$comments}</div>";
                    $body .= "<div class='col-md-8'></div>";
                    $body .= "<div class='col-md-4'>";
                        $body .= "<a href='subscribe.php?memId={$membId}' class='btn btn-success'>Subscribe</a>";                      
                    $body .= "</div>"; 
                    $body .= "<div class='col-md-12'><hr /></div>";  
                $body .= "</div>";
            //$body .= "</form>";
        endforeach;
        $body .= "</form>";  
        
 $objPage->displayPage($body);
?>