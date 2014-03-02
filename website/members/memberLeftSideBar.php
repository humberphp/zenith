<?php
/*
 * @author Jagsir Singh
 */
class memberLeftSideBar {
    //put your code here
    private $userId;

    public function __construct($userId){
        $this->userId = $userId;
    }
    public function displayLeftSideBar()
    {
     echo "<div class='col-sm-3  blog-sidebar'>
          <div class='sidebar-module'>
            <h4>User Details</h4>
            <p><img src='../img/thumbnail.png' alt='success-story' class='img-thumbnail' class='img-thumbnail'>
                <h4>Amta Bhancha</h4><p>Scarborough, Toronto</p>
            <a href='#'>Upload New Photo(s)</a> <br/>  
            <a href='#' class='active'>Edit your Details</a>  <br/> 
            <a href='#'>Renew Subcription</a> <br/>
            <a href='#'>Change your Subscription Plan</a>
              <hr>
            <ol class='list-unstyled'>
              <li><a href='#'>View Requests</a></li>
              <li><a href='#'>View Messages</a></li>
              <li><a href='#'>Other Actions</a></li>
            </ol>
          </div><!-- sidebar module -->
        </div><!-- /.blog-sidebar -->";
    }
}
