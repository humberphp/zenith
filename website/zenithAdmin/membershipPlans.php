<?php
    session_start();    
    include_once 'adminMasterPage.php';
    
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
    
    
        $body = "<form class='form-horizontal' method='post'>";
        $body .= "<h1>Hello</h1>";
        $body .= "</form>";  
       
 $objPage->displayPage($body);
    
?>