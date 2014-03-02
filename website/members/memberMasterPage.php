<?php
class memberMasterPage {
    private $meta_title;
    private $meta_keywords;
    private $meta_description;
    private $meta_author;
    private $html_body;
    private $page_heading;
    private $user;
    private $userId;

    public function __construct($user, $userId){
        $this->user = $user;
        $this->userId = $userId;
    }
    public function setTitle($title){
        $this->meta_title = $title;
    }    
    public function getTitle(){
        return $this->meta_title;
    }          
    public function setMetaKeywords($metakeywords){
        $this->meta_keywords = $metakeywords;
    }
    public function getMetaKeywords(){
        return $this->meta_keywords;
    }          
    public function setMetaDescription($metadescription){
        $this->meta_description = $metadescription;
    }
    public function getMetaDescription(){
        return $this->meta_description;
    }          
    public function setMetaAuthor($metaauthor){
        $this->meta_author = $metaauthor;
    }
    public function getMetaAuthor(){
        return $this->meta_author;
    }          
    public function setPageHeading($pageHeading){
        $this->page_heading = $pageHeading;
    }
    public function getPageHeading(){
        return $this->page_heading;
    }            
    
    public function getBody(){
        return $this->html_body;
    }
    public function setBody($pageBody){
        $this->html_body = $pageBody;
    }
    
    public function intializePaze(){
        $initial = '<!DOCTYPE html> <html  lang="en">
    	<head>
            <title>'.$this->getTitle().'</title>                  
            <meta charset="utf-8">
            <meta name="keywords" content="'.$this->getMetaKeywords().'" />  
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="'.$this->getMetaDescription().'" />  
            <meta name="author" content=""'.$this->getMetaAuthor().'" />  
            <link rel="shortcut icon" href="../assets/ico/favicon.ico">
            <!-- Bootstrap core CSS -->
            <link href="../css/bootstrap.min.css" rel="stylesheet">

            <!-- Custom styles for this template -->
            <link href="../styles/blog.css" rel="stylesheet">

            <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script src="../js/bootstrap.min.js"></script>
            <script src="../assets/js/docs.min.js"></script>
    	</head>
    	<body>';
        echo $initial;
    }
    public function displayHeader(){
        include_once 'memberHeader.php';
        $objHead = new memberHeader();
        $objHead->displayHeader($this->user);
    }    
    public function displayNavigation(){
        include_once 'memberNavigation.php';
    }    
//    public function displayBody() {
//    	$pageBody = '<div class="content">
//                <h1>'.$this->getPageHeading().'</h1>' 
//               . $this->getBody()
//               . '</div>';
//    	return $pageBody;
//    }
    public function startBodyContent()
    {
        echo "<div class='container'><div class='row'>";
    }
    public function displayLeftSideBar(){
        include_once 'memberLeftSideBar.php';
        $objLSide = new memberLeftSideBar($this->userId);
        $objLSide->displayLeftSideBar();
    }
    public function displayRightSideBar(){
        include_once 'memberRightSideBar.php';
        $objRSide = new memberRightSideBar($this->userId);
        $objRSide->displayRightSideBar();
    }
    public function endBodyContent()
    {
        echo "</div><!-- row -->
            </div><!-- /.container -->";
    }
    public function displayFooter(){
        include_once 'memberFooter.php';
    }    
    public function endPage(){
        $end =   '</body>
    	</html>';        
        echo $end;
    }
    
    
}
?>
