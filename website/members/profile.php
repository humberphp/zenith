<?php
// put your code here
 include_once 'memberMasterPage.php';
 require_once '../Database.php';
 
 $objPage = new memberMasterPage('Jagsir Singh ', 1);
 $objPage->setTitle('Zenith - Profile');
 $objPage->intializePaze();
 $objPage->displayHeader();
 $objPage->displayNavigation();
 $objPage->startBodyContent();
 $objPage->displayLeftSideBar();
#  ********************************  THIS IS MY CONTENT START *********************  

 
 
#  ********************************   THIS IS MY CONTENT END  *********************  
 
 $objPage->displayRightSideBar();
 $objPage->endBodyContent();
 $objPage->endPage();
?>