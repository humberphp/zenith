<?php
    session_start();    
    include_once 'adminMasterPage.php';
    include_once '../membershipPlansDB.php';
    
    $_SESSION['loginUserId'] = 1;
    $_SESSION['userFName'] = "Jagsir Singh";
    
    if(!isset($_SESSION['loginUserId']) || empty($_SESSION['loginUserId'])){
            header( 'Location: ../Login.aspx' ) ;
        }
        
        
    // ==================================== THIS CODE IS MUST  (START) =============================================================
    $objPage = new adminMasterPage($_SESSION['loginUserId']);       // THIS INFORMATION COMES FROM SESSIONS ONCE USER LOGS IN;
    $objPage->setTitle('Zenith - Membership Plans'); 
    $objPage->setMetaAuthor('this is meta author');
    // ==================================== THIS CODE IS MUST  (END) =================================================================
    
    $objMembership = new membershipPlansDB();
    
    //$memberships = $objMembership->
    
    $body = "<form class='form-horizontal' method='post'>";
    $body .= "<div id='divForm' style='padding:5px'>";
    $body .= "<h1>Hi!</h1>";
    $body .= "</div>";
    $body .= "<div id='divRecords' style='padding:5px'>";
    
    $body .= "<div class='form-group'>";
    $body .= "<div class='col-md-12'>";
    $body .= "<a href='#' id='addNew' class='btn btn-success'>Add New Membership Plan</a>";
    $body .= "</div>";
    $body .= "</div>";
    $body .= "<div class='form-group'>";
     $body .= "<div class='col-md-1'>";
    $body .= "</div>";
     $body .= "<div class='col-md-4'>";
    $body .= "</div>";
     $body .= "<div class='col-md-1'>";
    $body .= "</div>";
    $body .= "</div>";
    
    $body .= "</div>";
    
    $body .= "</form>";  
       
 $objPage->displayPage($body);
    
?>