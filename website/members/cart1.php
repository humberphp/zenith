<?php
    // put your code here
    session_start();    
    include_once 'memberMasterPage.php';
    include_once '../specialOffersDB.php';
 
    if(!isset($_SESSION['loginUserId']) || empty($_SESSION['loginUserId'])):
        header( 'Location: ../index.php' ) ;
    endif;
    $userId = $_SESSION['loginUserId'];      

    
    $objPage = new memberMasterPage($userId);       // THIS INFORMATION COMES FROM SESSIONS ONCE USER LOGS IN;
    $objPage->setTitle('Zenith - Profile'); 
    $objPage->setMetaAuthor('this is meta author');
    

    $body = "<form class='form-horizontal' method='post'>";
    $body .= "<br/>";        
    if(!isset($_GET["speId"])){
    }
    else { 
        $speId = $_GET["speId"];          

        $obj = new specialOffersDB();
        $OfferDet = $obj->getOfferDetails($speId);

        if(count($OfferDet)>0):
            $offer = $OfferDet[0]['special'];
            $dayAllowed = $OfferDet[0]['daysAllowed'];
            $prices = $OfferDet[0]['price'];

            $body .= "<br/>";
            $body .= "<div  class='form-group'>";
                $body .= "<label class='col-md-6 control-label'>Offer:</label>";
                $body .= "<div class='col-md-6'>"; 
                    $body .= "<label id='lblOffer' name='lblOffer' style='font-weight: normal;'>{$offer}</label>";   
                $body .= "</div>"; 
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
                $body .= "<label class='col-md-6 control-label'>Days Allowed:</label>";
                $body .= "<div class='col-md-6'>"; 
                    $body .= "<label id='lblDays' name='lblDays' style='font-weight: normal;'>{$dayAllowed}</label>";   
                $body .= "</div>"; 
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
                $body .= "<label class='col-md-6 control-label'>Price:</label>";
                $body .= "<div class='col-md-6'>"; 
                    $body .= "<label id='lblPrice' name='lblPrice' style='font-weight: normal;'>{$prices}</label>";   
                $body .= "</div>"; 
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
                $body .= "<div class='col-md-6'></div>";
                $body .= "<div class='col-md-6'>";
//                    $body .="<a href='success.php?ptrb={$userId}&item_number={$memId}&tx=2'>Test</a><br/>";
                    $body .= "<a href='https://sandbox.paypal.com/cgi-bin/webscr"
                            . "?cmd=_xclick"
                            . "&business=kpatelp@gmail.com"
                            . "&item_name={$offer}"
                            . "&amount={$prices}"
                            . "&item_number={$speId}"
                            . "&return=http://www.jagsirsingh.com/zenith/members/successOffers.php?pt={$userId}"
                            . "&cancel_return=http://www.jagsirsingh.com/zenith/members/cart1.php?speId={$speId}"
                            . "&currency=CAD' class='btn btn-success' >checkout</a>";
                $body .= "</div>";
            $body .= "</div>";     
          
        endif;
        
    }
    $body .= "</form>";  
    $objPage->displayPage($body);
?>