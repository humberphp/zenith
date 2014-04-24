<?php
    // put your code here
    session_start();    
    include_once 'memberMasterPage.php';
    include_once '../specialOffersDB.php';

    
    
    
    if(!isset($_SESSION['loginUserId']) || empty($_SESSION['loginUserId'])):
        header( 'Location: ../index.php' ) ;
    endif;
    $userId = $_SESSION['loginUserId'];      
    $obj = new specialOffersDB();

        if(isset($_GET["pt"])){
            $useId = $_GET["pt"]; // THIS WILL BE THE VALUE FROM QUERYSTRING
            $speId=$_GET['item_number'];
            $transId=$_GET['tx'];
            $obj->addUserToOffers($userId, $speId);
        }
        
    // ==================================== THIS CODE IS MUST  (START) ========================================================
    $objPage = new memberMasterPage($userId);       // THIS INFORMATION COMES FROM SESSIONS ONCE USER LOGS IN;
    $objPage->setTitle('Zenith - Profile'); 
    $objPage->setMetaAuthor('this is meta author');
    // ==================================== THIS CODE IS MUST  (END) ==========================================================
    
    

    $body = "<form class='form-horizontal' action='https://sandbox.paypal.com/cgi-bin/webscr' method='post'>";
    $body .= "<br/>";        
     $body .= "<div  class='form-group'>";
        $body .= "<label class='col-md-2 control-label'>Note:</label>";
        $body .= "<div class='col-md-10'>"; 
            $body .= "<label id='lblOffer' name='lblOffer' style='font-weight: normal;'>You have subsribed to the offer</label>";   
        $body .= "</div>"; 
    $body .= "</div>";
    
    $body .= "</form>";  
    $objPage->displayPage($body);
?>