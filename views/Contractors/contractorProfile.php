<?php

session_start();

if(!isset($_SESSION['user_email']) ) {
    header("Location:../../index.php");
}
if(strcmp($_SESSION['user_type'], "contractors") ) {
    header("Location:../../index.php");
}
include '../../src/common/DBConnection.php';

$conn=new DBConnection();
$CID=$_SESSION['user_id'];
$info=$conn->getOne("SELECT * FROM contractors WHERE id = '$CID'");
$finishedService = $conn-> getAll(" SELECT * FROM service_list INNER JOIN contractors ON service_list.contractor_ID = contractors.id WHERE service_list.contractor_ID = '$CID' AND service_list.state = 'finished' ");
$rate=$conn->getAll(" SELECT service_list.Rating
						FROM service_list INNER JOIN services ON service_list.service_ID = services.id 
						WHERE service_list.contractor_ID = '$CID' ");
						
$finalRate=0;
if ($rate)
{
	for($i=0; $i<count($rate); $i++)
	{
		$finalRate+=$rate[$i]["Rating"];
	}
	$finalRate=$finalRate/count($rate);
}
$totalCustomers = $conn-> getAll(" SELECT DISTINCT customer_ID FROM service_list INNER JOIN contractors ON service_list.contractor_ID = contractors.id WHERE service_list.contractor_ID = '$CID' AND service_list.state = 'finished' ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>QService - Home Services & More</title>

    <!-- Bootstrap -->
    <link href="../../resource/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../resource/css/font-awesome.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../resource/css/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../../resource/css/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../../resource/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../../resource/css/buttons.bootstrap.css" rel="stylesheet">
    <link href="../../resource/css/fixedHeader.bootstrap.css" rel="stylesheet">
    <link href="../../resource/css/responsive.bootstrap.css" rel="stylesheet">
    <link href="../../resource/css/scroller.bootstrap.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../../resource/css/custom.css" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">

        <!-- side and top bar include -->
        <?php include '../partPage/sideAndTopBarMenuContractor.html' ?>
        <!-- /side and top bar include -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">


                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                                
                            <div class="x_content">
							<p class="text-muted font-13 m-b-30"></p>
							
					<div class="container bootstrap snippet">
						<div class="row">
							<div class="col-sm-10"><h1><?php echo$_SESSION['fname']; echo(' '); echo$_SESSION['lname'];?></h1></div>
							</div>
						<hr>
						<div class="row">
							<div class="col-sm-3"><!--left col-->
								<div class="text-center">
								<div class="profile_pic" style="width:100%; padding:10px;">
								<img src="../../resource/images/user.png" alt="..." class="img-circle profile_img"style="margin: auto;">
								</div>
								<h5>Addtional Information</h5>
								
						</div><hr><br>

               
          <div class="panel panel-default">
            <div class="panel-heading" style="text-align: center;">Website <i class="fa fa-link fa-1x"></i></div>
            <div class="panel-body" style="text-align: center;"><a href="">user.com</a></div>
          </div>
          
          
          <ul class="list-group">
            <li class="list-group-item text-muted " style="text-align: center;">User Board <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Total Services</strong></span> <?=count($finishedService);?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Total Customers</strong></span> <?=count($totalCustomers);?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Rating</strong></span> <?=($finalRate); ?>/10</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Status</strong></span> <?=($info['state']); ?></li>
          </ul> 
               
          <div class="panel panel-default">
            <div class="panel-heading" style="text-align: center;">Social Media</div>
            <div class="panel-body" style="text-align: center;">
            	<i class="fa fa-facebook fa-2x"></i></i> <i class="fa fa-twitter fa-2x"></i><i class="fa fa-google-plus fa-2x"></i>
            </div>
          </div>
          
        </div><!--/col-3-->
    	<div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Information</a></li>
              </ul>

              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>
                  <form class="form" action="../../src/store/editContractorProfile.php" method="post" id="registrationForm">
                        <?php if(isset($_GET['error'])){
                        echo "<div class='alert alert-danger' role='alert'>".
                        $_GET['error']
                        ."</div>";
                        }
                        if(isset($_GET['msg'])){
                            echo "<div class='alert alert-success' role='alert'>".
                            $_GET['msg']
                            ."</div>";
                        }
                        ?>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="first_name"><h4>First name</h4></label>
                              <input type="text" class="form-control" name="first_name" id="first_name" value="<?=($info['fname']) ?>" title="enter your first name if any.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="last_name"><h4>Last name</h4></label>
                              <input type="text" class="form-control" name="last_name" id="last_name" value="<?=($info['lname']) ?>" title="enter your last name if any.">
                          </div>
                      </div>
          
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="phone"><h4>Phone</h4></label>
                              <input type="text" class="form-control" name="phone" id="phone" value="<?=($info['phone']) ?>" title="enter your phone number if any.">
                          </div>
                      </div>
          
                      <div class="form-group">
                          <div class="col-xs-6">
                             <label for="speciality"><h4>Speciality</h4></label>
                              <input type="text" class="form-control" name="speciality" id="speciality" value="<?=($info['speciality']) ?>" title="enter your mobile number if any.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Email</h4></label>
                              <input type="email" class="form-control" name="email" id="email" value="<?=($info['email']) ?>" title="enter your email.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Location</h4></label>
                              <input type="text" class="form-control" name="location" id="location" value="<?=($info['location']) ?>" title="enter a location">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="password"><h4>Password</h4></label>
                              <input type="password" class="form-control" name="password" id="password" placeholder="Enter New Password" onchange="form.pwd2.pattern = this.value;" minlength="6" required>
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="password2"><h4>Verify Password</h4></label>
                              <input type="password" class="form-control" name="pwd2" id="password2" placeholder="Re-enter Password" title="Passwords dose not match" required>
                          </div>
                      </div>
                      <div class="form-group">
                           <div class="col-xs-12 col-xs-6">
                                <br>
                              	<button type="reset" class="btn btn-primary">Reset</button>
                                <button name="btn-notice" id="btn-notice" type="submit" class="btn btn-success">Submit</button>
                            </div>
                      </div>
              	</form>
              </div>
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
							
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
<!-- footer content include -->
        <?php include '../partPage/footer.html' ?>
        <!-- /footer content include -->
    </div>
</div>

<!-- jQuery -->
<script src="../../resource/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../../resource/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../resource/js/fastclick.js"></script>
<!-- NProgress -->
<script src="../../resource/js/nprogress.js"></script>
<!-- iCheck -->
<script src="../../resource/js/icheck.min.js"></script>
<!-- Datatables -->
<script src="../../resource/js/jquery.dataTables.min.js"></script>
<script src="../../resource/js/dataTables.bootstrap.min.js"></script>
<script src="../../resource/js/dataTables.buttons.min.js"></script>
<script src="../../resource/js/buttons.bootstrap.min.js"></script>
<script src="../../resource/js/buttons.flash.min.js"></script>
<script src="../../resource/js/buttons.html5.min.js"></script>
<script src="../../resource/js/buttons.print.min.js"></script>
<script src="../../resource/js/dataTables.fixedHeader.min.js"></script>
<script src="../../resource/js/dataTables.keyTable.min.js"></script>
<script src="../../resource/js/dataTables.responsive.min.js"></script>
<script src="../../resource/js/responsive.bootstrap.js"></script>
<script src="../../resource/js/dataTables.scroller.min.js"></script>
<script src="../../resource/js/jszip.min.js"></script>
<script src="../../resource/js/pdfmake.min.js"></script>
<script src="../../resource/js/vfs_fonts.js"></script>
<!-- Custom Theme Scripts -->
<script src="../../resource/js/custom.min.js"></script>
</body>
</html>
