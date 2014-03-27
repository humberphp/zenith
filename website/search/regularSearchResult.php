<?php
include_once '../database.php';
global $db;
$db = Database::getDB();
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
                <link rel="stylesheet" href="../styles/RegularSearch.css">

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
        <script  src="../js/regularSearch.js"></script>
        <style>
           .table-striped > tbody > tr > td, .table-striped > tbody > tr > th {
    background-color: #F9F9F9;
    font-size: x-small;
   
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
  
    vertical-align:  middle;
    padding: 0px;
  
}
        </style>

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
                        <form class="form-horizontal"  method="post" action="regularSea.php"  name="searchForm" onsubmit="return validationCheck()">
                            <fieldset>
                                <!--   code start for search   -->

                                <p id="test"></p>

                               
                                <?php
                                $sex = $_POST['sex'];
                                $agefrom = $_POST['ageFrom'];
                                $ageto = $_POST['ageTo'];
                                $heightfrom = $_POST['heightFrom'];
                                $heightto = $_POST['heightTo'];
                                $maritalstatus = $_POST['maritalStatus'];
                                $religion = $_POST['religion'];
                                $mtoungue = $_POST['mtoungue'];
                                $country = $_POST['country'];
                                $education = $_POST['education'];
                                $withphoto = $_POST['withPhoto'];
                               // echo "$sex" . " <br/> " . "$agefrom" . " <br/>  " . "$ageto" . " <br/>  " . "$heightfrom" . " <br/>  " . "$heightto" . " <br/> " . "$maritalstatus-" . " <br/> " . "$religion " . " <br/> " . "$mtoungue" . " <br/> " . "$country" . " <br/> " . "$education-" . " <br/> " . "$withphoto";
                              //  $query = "select tu.firstName,tub.gender,tub.age,tub.height,tub.weight,tub.motherTounge,tub.martialStatus from tbl_users as tu,tbl_userbasicdetails as tub
//where tu.userId=tub.userId";
   $query=" select tu.firstName,tub.gender,tub.age,tub.height,tub.weight,tub.motherTounge,tub.martialStatus,tui.imageId,tui.image from tbl_users as tu inner join (tbl_userbasicdetails as tub,tbl_userimages as tui)
on( tu.userId=tub.userId and tu.userId=tui.userId)";
                                //  $db=  Database::getDB();
                                $searchResult = $db->query("$query");

                                foreach ($searchResult as $s) {
                                    ?>    
                                    <div class="row">
                                        <table class="table table-striped table-hover ">
                                            <tr><td rowspan="7" class="glyphicon-picture"><img src=<?php echo '../'.$s["image"]; ?>  style=" width: 150px ;height: 150px;"</td><td >Name : <td><?php echo $s["firstName"]; ?></td></tr>
                                            <tr><td>Sex : <td><?php echo $s["gender"]; ?></td></tr>
                                            <tr><td>Height : <td><?php echo $s["height"]; ?></td></tr>
                                            <tr><td>Weight : <td><?php echo $s["weight"]; ?></td></tr>
                                            <tr><td>Mother Tounge<td><?php echo $s["motherTounge"]; ?></td></tr>
                                            <tr><td>Martial Status : <td><?php echo $s["martialStatus"]; ?></td></tr>
                                            <tr><td> </td><td><a href="#" >View full profile</a></td></tr>




                                        </table>
                                    </div>
<?php }
?>          


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

