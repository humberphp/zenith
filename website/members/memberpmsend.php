<?php
    // put your code here
    session_start();   

    include_once './memberMasterPage.php';
    require_once '../userInfoDB.php';
    
    // note for me(jassi): make the following code querystring based
    $_SESSION['loginUserId'] = 4;
    $_SESSION['userFName'] = "Tunde";
    
    if(!isset($_SESSION['loginUserId']) || empty($_SESSION['loginUserId'])){
            header( 'Location: ../Login.aspx' ) ;
        }
 
        if(isset($_GET["searchUserId"])){
            $searchUserId = $_GET["searchUserId"]; // THIS WILL BE THE VALUE FROM QUERYSTRING
        }
        else {
            $searchUserId = $_SESSION['loginUserId'];
        }
 
        
        // ==================================== THIS CODE IS MUST  (START) ==============================================
        $objPage = new memberMasterPage($_SESSION['loginUserId']);       // THIS INFORMATION COMES FROM SESSIONS ONCE USER LOGS IN;
        $objPage->setTitle('Zenith - Submit Sucess Story'); 
        $objPage->setMetaAuthor('this is meta author');
        // ==================================== THIS CODE IS MUST  (END) ==============================================
  
        $objUsers = new userInfoDB();
  
        $personalAcc = false;
        $act = '';
        if($searchUserId == $_SESSION['loginUserId']){
            $personalAcc = true;
            
            if(isset($_GET['actEdit'])){
                $act = $_GET['actEdit'];
            }
        }
        
        $body = '<form class="form-horizontal" action="thisindex.php" method="post" name="successform">';
        $body .= '<fieldset>';
        //Form Name -->
        $body .= '<legend>Send Private Message</legend>';  
        
        //Text input
        $body .= '<div class="form-group">';
        $body .= '<label class="col-md-4 control-label" for="title">Title: </label>';
        $body .= '<div class="col-md-8">';
        $body .= '<input id="title" name="title" class="form-control input-md" required type="text">';
        $body .= '</div>';
        $body .= '</div>';
         //Text input
        $body .= '<div class="form-group">';
        $body .= '<label class="col-md-4 control-label" for="title">To: </label>';
        $body .= '<div class="col-md-8">';
        $body .= '<input id="receiver" name="receiver" class="form-control input-md" required type="text">';
        $body .= '</div>';
        $body .= '</div>';
        //Date Picker
        $body .= '<div class="form-group">';
        $body .= '<label class="col-md-4 control-label" for="subdate">Date: </label>';
        $body .= '<div class="col-md-8">';
        $body .= '<input id="subdate" name="subdate" class="form-control input-md" required type="datetime">';
        $body .= '<span class="help-block">Format Required (Y-mm-dd 24:00:00)</span>';
        $body .= '</div>';
        $body .= '</div>';
        //Textarea 
        $body .= '<div class="form-group">';
        $body .= '<label class="control-label" for="message" pull left>Enter Your Message: </label><br/>';
        $body .= '<div class="col-md-12">';
        $body .= '<textarea class="form-control" id="message" name="message" required></textarea>';
        $body .= '<span class="help-block">Enter your message(max 500 characters)</span>';
        $body .= '</div>';
        $body .= '</div>';
        //Submit Button 
        $body .= '<div class="form-group">';
        $body .= '<label class="col-md-8 control-label" for="userpm"></label>';
        $body .= '<div class="col-md-4">';
        $body .= '<button id="subStory" name="userpm" class="btn btn-success">Submit</button>';
        $body .= '</div>';
        $body .= '</div>';
        $body .= '</fieldset>';
        $body .= '</form>';

        $objPage->displayPage($body);
        
?>        