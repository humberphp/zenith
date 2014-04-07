<?php
    // put your code here
    session_start();    
    include_once 'memberMasterPage.php';
    require_once '../userInfoDB.php';
    require_once '../Database.php';
    require_once 'userPM.php';

    $success = '';
    $error = '';
    if (isset($_POST['body'])){
        //Validating inputs
    
        $title = $_POST['title'];
        $body = $_POST['body'];
        $sender = $_POST['sender']; 
        $receiver = $_POST['receiver']; 
        $sender = $_POST['sender']; 

            if (empty($message) || empty($submitDate) || empty ($storyTitle) ){
             $error = "All fields must to be filled properly prior to submission, Try Again!";
            
           } else {
             //add story to database
               $newmessage = new userPM(); //This is to create the object of class userPM
               $row = $newmessage->SendMessage($title ,$body ,$sender ,$receiver ,$sender); //This is to call the function SendMessage  of the class
               $success = "Your message was sent successfully!";
           } 
    }  
 
    // note for me(jassi): make the following code querystring based
    $_SESSION['loginUserId'] = 4;
    $_SESSION['userFName'] = "Tunde";
    
    if(!isset($_SESSION['loginUserId']) || empty($_SESSION['loginUserId'])){
            header( 'Location: ../login.php' ) ;
        }
 
        if(isset($_GET["searchUserId"])){
            $searchUserId = $_GET["searchUserId"]; // THIS WILL BE THE VALUE FROM QUERYSTRING
        }
        else {
            $searchUserId = $_SESSION['loginUserId'];
        }
 
        
        // ==================================== THIS CODE IS MUST  (START) ==============================================
        $objPage = new memberMasterPage($_SESSION['loginUserId']);       // THIS INFORMATION COMES FROM SESSIONS ONCE USER LOGS IN;
        $objPage->setTitle('Zenith - User Private Message Update'); 
        $objPage->setMetaAuthor('this is meta author');
        // ==================================== THIS CODE IS MUST  (END) ==============================================
  
        $body = "<form class='form-horizontal' method='post'>";
        $body .="<h1>Private Message Submission</h1>";
        $body .= "<p> $success </p>";
        $body .= "<p> $error </p>";
        $body .="</form>";
        $objPage->displayPage($body);
        
?>      header ('location' ../)