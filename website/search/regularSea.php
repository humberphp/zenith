<?php
include_once '../database.php';
  global $db;
                    $db=  Database::getDB();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../project2/docs/examples/blog/assets/ico/favicon.ico">
   
    <title>Zenith - Edit Details</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../blog.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
     <link rel="stylesheet" href="../styles/RegularSearch.css">
     <script  src="../js/regularSearch.js"></script>
  </head>

  <body>
    <div class="container"><!-- Container is a class used throughout the document -->
    <div id="logo"><a href="index.html"><img src="img/logo.png" alt="Zenith Matrimony"></a></div>
    <div id="login">
    Welcome, Amta Bhancha
    <button type="button" class="btn btn-warning">Sign Out</button>
   
    </div>
    </div>
    <div class="blog-masthead"><!-- Navigation starts here -->
      <div class="container">
      
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"></a> <!-- Acts as the logo as text -->
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="#hot offers">Hot Offers</a></li>
            <li><a href="#register">Register</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Search <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div><!-- container ends -->
    </div><!-- Bolg-masthead ends here -->

    <div class="container">

     <div class="row">
      
      <div class="col-sm-3  blog-sidebar">
          <div class="sidebar-module">
            <h4>User Details</h4>
            <p><img src="img/thumbnail.png" alt="success-story" class="img-thumbnail" ><h4>Amta Bhancha</h4><p>Scarborough, Toronto</p>
            <a href="#">Upload New Photo(s)</a> <br/>  
            <a href="#" class="active">Edit your Details</a>  <br/> 
            <a href="#">Renew Subcription</a> <br/>
            <a href="#">Change your Subscription Plan</a>
              <hr>
            <ol class="list-unstyled">
              <li><a href="#">View Requests</a></li>
              <li><a href="#">View Messages</a></li>
              <li><a href="#">Other Actions</a></li>
            </ol>
          </div><!-- sidebar module -->
        </div><!-- /.blog-sidebar -->

        <div class="col-sm-6 blog-main">

          <div class="blog-post">
             <form class="form-horizontal"  method="post" action="regularSearchResult.php"  name="searchForm" onsubmit="return validationCheck()">
<fieldset>
  <!--   code start for search   -->
 
  <p id="test"></p>

  <div class="search"><!--   div start for search   -->
      <p>Regular Search is the most popular search based on a few important criteria one would look for in a life partner</p>
      <h3>Basic Search Criteria</h3>
      <hr />
      <table>
        <tr>
            <td>Gender : </td>
            <td>Male<input type="radio" name="sex" value="Male"  checked="checked" /></td>
            <td colspan="2">Female<input type="radio" name="sex" value="Female" /></td>
            
        </tr>
        <tr>
            <td>Age :</td>
            
            <td><input type="text" size="2" name="ageFrom" required="required"> </td>
            <td >to</td>
              <td><input type="text" size="2" name="ageTo"  required="required"> </td>
        </tr>
       <tr>
            <td>Height : </td>
            
            <td>
               
                <select name="heightFrom">
                    <option value="4" >4ft 4in</option>
                                        <option value="4" >4ft 6in</option> 
                    <option value="4" >4ft 8in</option> 
                    <option value="4" >4ft 10in</option> 
                    <option value="4" >4ft 12in</option> 
<option value="5" >5ft 2in</option>
                    <option value="5" >5ft 4in</option>
                    <option value="5" >5ft 6in</option>
                    <option value="5" >5ft 8in</option>
                    <option value="5" >5ft 10in</option>
                    <option value="5" >5ft 12in</option>
                    <option value="6" >6ft 2in</option>
                      <option value="6" >6ft 4in</option>
                        <option value="6" >6ft 6in</option>
                          <option value="6" >6ft 8in</option>
                            <option value="6" >6ft 10in</option>
                              <option value="6" >6ft 12in</option>
                              <option value="7" >7ft Plus </option>
                </select> </td>
            <td >to</td>
            <td><select name="heightTo">
                <option value="4" >4ft 4in</option>
                                        <option value="4" >4ft 6in</option> 
                    <option value="4" >4ft 8in</option> 
                    <option value="4" >4ft 10in</option> 
                    <option value="4" >4ft 12in</option> 
<option value="5" >5ft 2in</option>
                    <option value="5" >5ft 4in</option>
                    <option value="5" >5ft 6in</option>
                    <option value="5" >5ft 8in</option>
                    <option value="5" >5ft 10in</option>
                    <option value="5" >5ft 12in</option>
                    <option value="6" >6ft 2in</option>
                      <option value="6" >6ft 4in</option>
                        <option value="6" >6ft 6in</option>
                          <option value="6" >6ft 8in</option>
                            <option value="6" >6ft 10in</option>
                              <option value="6" >6ft 12in</option>
                              <option value="7" >7ft Plus </option>
                </select> </td>
        </tr>
        <tr>
            <td>Marital status :</td>
            <td colspan="3">Any <input type="checkbox" name="maritalStatus" value="1" checked="checked">
            Unmarried <input type="checkbox" name="maritalStatus" value="2">
           Widow <input type="checkbox" name="maritalStatus" value="3">
                      Divorced <input type="checkbox" name="maritalStatus" value="4">
           

            </td>
           
        </tr>
        <tr>
            <td>Religion :</td>
            <td colspan="3">
                
                <select name="religion">
                    <option value="selectReligion">Select Religion...</option>
                    <?php 
                  
                    $q="select * from tbl_religions";
                   $result= $db->query($q);
                  
                   foreach ($result as $r) {
                    ?>
                    <option value=<?php echo $r["religionId"]; ?>><?php echo $r["religion"]; ?></option>
                   <?php } ?>
                </select></td>
        </tr>
          <tr>
            <td>Mother Tongue :</td>
            <td colspan="3"><input type="text" name="mtoungue"></td>
        </tr>
         <tr>
            <td>Country :</td>
            <td colspan="3"> <select name="country">
                     <option value="selectCountry">Select Country...</option>
                    <?php 
                    //$db=  Database::getDB();
                    $query="select countryId,countryName from tbl_country";
                   $res= $db->query($query);
                   foreach ($res as $r) {
                    ?>
                    <option value=<?php echo $r["countryId"]; ?>><?php echo $r["countryName"]; ?></option>
                   <?php } ?>
                </select></td>
        </tr>
         <tr>
            <td>Education :</td>
            <td colspan="3"><select name="education">
                    <option value="">Education...</option>
                    <option value="Information Technology">Information Technology</option>
                     <option value="Web Developer">Web Developer</option>
                     <option value="Architecture and Engineering">Architecture and Engineering</option>
                     <option value="Arts, Design, Entertainment, Sports, and Media" >Arts, Design, Entertainment, Sports, and Media</option>
                     <option value="Business and Financial Operations" >Business and Financial Operations</option>
                      <option value="Community and Social Service" >Community and Social Service</option>
                       <option value="Construction and Extraction" >Construction and Extraction</option>
                        <option value="Healthcare Practitioners and Technical" >Healthcare Practitioners and Technical</option>
                         <option value="other" >Other</option>
 </select>
            </td>
        </tr>
        <tr>
            <td>Show Profile :</td>
            <td>With Photo <input type="radio" name="withPhoto" value="1"></td>
            <td colspan="2">Any <input type="radio" name="withPhoto" value="2" checked="checked"></td>
        </tr>
        <tr>
            <td colspan="4"><input type="submit" name="submitForm"   value="Search"></td>
        
        </tr>
       
    </table>
      <div id="errorMassage"></div>
 <!--   code end for search   -->
  </div><!-- end of div search -->
 
  
 
    </fieldset>
</form>
     
      </div><!-- /.blog-post --> 
      </div><!-- /col sm-6 -->

        <div class="col-sm-3 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>Highlighted Profiles</h4>
      <p><img src="img/thumbnail.png" alt="success-story" class="img-thumbnail" class="img-thumbnail"><h4>Amta Russell</h4><p>Scarborough, Toronto</p><p><a href="#">Send your Interest</a>  |  <a href="#">Send a Private Message</a>  |  <a href="#">Request contact details</a></p><br/>
              <hr>
          <p><img src="img/thumbnail.png" alt="success-story" class="img-thumbnail" class="img-thumbnail"><h4>User Two</h4><p>Woodbridge, Toronto</p><p><a href="#">Send your Interest</a>  |  <a href="#">Send a Private Message</a>  |  <a href="#">Request contact details</a></p><br/>
          </div>
 </div><!-- /.blog-sidebar -->
 </div><!-- row -->
 </div><!-- /.container -->

    <div class="blog-footer">
      <p> THIS IS A STUDENT PROJECT WEBSITE FOR HUMBER COLLEGE WEB DEV PROGRAM &copy; Team Zenith - All Rights Reserved 2014 </p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="assets/js/docs.min.js"></script>
  </body>
</html>

