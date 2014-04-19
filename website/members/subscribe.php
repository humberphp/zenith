<?php
    // put your code here
    session_start();    
    include_once 'memberMasterPage.php';
    include_once '../membershipPlansDB.php';
//    require_once '../userInfoDB.php';
//    require_once '../commonDB.php';
    
    
    
    if(!isset($_SESSION['loginUserId']) || empty($_SESSION['loginUserId'])):
        header( 'Location: ../index.php' ) ;
    endif;      

    // ==================================== THIS CODE IS MUST  (START) ========================================================
    $objPage = new memberMasterPage($_SESSION['loginUserId']);       // THIS INFORMATION COMES FROM SESSIONS ONCE USER LOGS IN;
    $objPage->setTitle('Zenith - Profile'); 
    $objPage->setMetaAuthor('this is meta author');
    // ==================================== THIS CODE IS MUST  (END) ==========================================================
    
    $body = "";
    $objPage->displayPage($body);
?>