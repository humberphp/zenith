<?php
/*
 * @author Jagsir Singh
 */
class memberRightSideBar {
    //put your code here
    private $userId;

    public function __construct($userId){
        $this->userId = $userId;
    }
    public function displayRightSideBar()
    {
     echo "<div class='col-sm-3 blog-sidebar'>
          <div class='sidebar-module sidebar-module-inset'>
            <h4>Highlighted Profiles</h4>
      <p><img src='../img/thumbnail.png' alt='success-story' class='img-thumbnail' class='img-thumbnail'><h4>Amta Russell</h4>
      <p>Scarborough, Toronto</p>
      <p><a href='#'>Send your Interest</a>  |  <a href='#'>Send a Private Message</a>  |  <a href='#'>Request contact details</a></p><br/>
              <hr>
          <p><img src='../img/thumbnail.png' alt='success-story' class='img-thumbnail' class='img-thumbnail'><h4>User Two</h4><p>Woodbridge, Toronto</p>
          <p><a href='#'>Send your Interest</a>  |  <a href='#'>Send a Private Message</a>  |  <a href='#'>Request contact details</a></p><br/>
          </div>
 </div><!-- /.blog-sidebar -->
 </div><!-- row -->
 </div><!-- /.container -->";
    }
}
