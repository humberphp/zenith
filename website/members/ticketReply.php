<?php
    // put your code here
    session_start();    
    include_once 'memberMasterPage.php';
    require_once '../supportTicketsDB.php';
 
    // note for me(jassi): make the following code querystring based
    $_SESSION['loginUserId'] = 4;
    $_SESSION['userFName'] = "Tunde";
    
    if(!isset($_SESSION['loginUserId']) || empty($_SESSION['loginUserId'])){
            header( 'Location: ../Login.aspx' ) ;
        }
         
        // ==================================== THIS CODE IS MUST  (START) ==============================================
        $objPage = new memberMasterPage($_SESSION['loginUserId']);       // THIS INFORMATION COMES FROM SESSIONS ONCE USER LOGS IN;
        $objPage->setTitle('Zenith - Profile'); 
        $objPage->setMetaAuthor('this is meta author');
        // ==================================== THIS CODE IS MUST  (END) ==============================================
        
        $objTickets = new supportTicketsDB();
   
        $body = "<form class='form-horizontal' method='post'>";
        $body .= "<input type='hidden' id='hdUId' name='hdUId' value='{$_SESSION['loginUserId']}'>";
        $body .= "</form>";        
        
 $objPage->displayPage($body);
?>