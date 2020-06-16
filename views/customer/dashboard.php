<?php

session_start();

include '../../src/common/DBConnection.php';

$conn=new DBConnection();

$CID=$_SESSION['user_id'];

if(!isset($_SESSION['user_email']) ) {
    header("Location:../../index.php");
}
if(strcmp($_SESSION['user_type'], "customers") ) {
    header("Location:../../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>QService - Home Services & More</title>

      <!-- Bootstrap -->
      <link href="../../resource/css/bootstrap.css" rel="stylesheet">
      <!-- Font Awesome -->
      <link href="../../resource/css/font-awesome.css" rel="stylesheet">
      <!-- NProgress -->
      <link href="../../resource/css/nprogress.css" rel="stylesheet">
      <!-- iCheck -->
      <link href="../../resource/css/green.css" rel="stylesheet">
      <!-- bootstrap-progressbar -->
      <link href="../../resource/css/bootstrap-progressbar-3.3.4.css" rel="stylesheet">
      <!-- JQVMap -->
      <link href="../../resource/css/jqvmap.css" rel="stylesheet"/>
      <!-- bootstrap-daterangepicker -->
      <link href="../../resource/css/daterangepicker.css" rel="stylesheet">
      <!-- Custom Theme Style -->
      <link href="../../resource/css/custom.css" rel="stylesheet">
      <link rel="stylesheet" href="style.css">
</head>
<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<?php include("../partPage/sideAndTopBarMenuCustomer.html");?>
		</div>
		<div class="right_col" role="main">
			<div class="">
				<div class="page-title">
                    <div class="title_left">
                        <h3>Lets Get Started, Choose a Service!</h3>
                    </div>
				</div>
				<div class="clearfix"></div>
					<div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
							<div class="x_title">
                                
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
								<a href="Requestservice.php?service-type=PLUMBING">
									<div class="card col-md-4 col-sm-6" style="border-radius: 20px; margin-left:0px; margin-right:0px;">
									<h4><i class="fa fa-gears"></i><b> PLUMPING</b></h4>
									<p>Filters, Pipelines, Pumps, Water Tanks, Tap, Wash Basin and Sinks, Leakages.</p>
									</div>
								</a>
								<a href="Requestservice.php?service-type=ELECTRICITY">
									<div class="card col-md-4 col-sm-6" style="border-radius: 20px; margin-left:0px; margin-right:0px;">
									<h4><i class="fa fa-bolt"></i><b> ELECTRICITY</b></h4>
									<p>Electrician Wiring, Fans,Lighting, Fitting or Installation or repairing.</p>
            						</div>
								</a>

								<a href="Requestservice.php?service-type=SATELLITE">
									<div class="card col-md-4 col-sm-6" style="border-radius: 20px; margin-left:0px; margin-right:0px;">
									<h4><i class="fa fa-bullseye"></i><b> SATELLITE</b></h4>
									<p>Install, maintenance, troubleshooting and wiring for satellite systems.</p>
									</div>

								</a>
								<a href="Requestservice.php?service-type=GARDENING">
									<div class="card col-md-4 col-sm-6" style="border-radius: 20px; margin-left:0px; margin-right:0px;">
									<h4><i class="fa fa-leaf"></i><b> GARDENING & LANDSCAPING</b></h4>
									<p>Maintaining beautiful, functional outdoor spaces and gardens.</p>
									</div>

								</a>
								<a href="Requestservice.php?service-type=AIR">
									<div class="card col-md-4 col-sm-6" style="border-radius: 20px; margin-left:0px; margin-right:0px;">
									<h4><i class="fa fa-ge"></i><b> AIR CONDITIONING</b></h4>
									<p>AC Repairing, installation, Gas top-up and refill and Repair.</p>
									</div>
								</a>
								<a href="Requestservice.php?service-type=HEATING">
									<div class="card col-md-4 col-sm-6" style="border-radius: 20px; margin-left:0px; margin-right:0px;">
									<h4><i class="fa fa-fire"></i><b> HEATING</b></h4>
									<p>Heating systems (Gas, Diesel), Radiators repair and fitting.</p>
									</div>
								</a>
								<a href="Requestservice.php?service-type=REMODELING">
									<div class="card col-md-4 col-sm-6" style="border-radius: 20px; margin-left:0px; margin-right:0px;">
									<h4><i class="fa fa-building-o"></i><b> REMODELING & CONSTRUCTIONS</b></h4>
									<p>General construction works, interior and exterior remodeling.</p>
									</div>
								</a>
								<a href="Requestservice.php?service-type=PAINTING">
									<div class="card col-md-4 col-sm-6" style="border-radius: 20px; margin-left:0px; margin-right:0px;">
									<h4><i class="fa fa-hand-stop-o"></i><b> PAINTING & INTERIOR</b></h4>
									<p>Painting walls, assembling wallpapers and Interior design work.</p>
									</div>
								</a>
								<a href="Requestservice.php?service-type=SECURITY">
									<div class="card col-md-4 col-sm-6" style="border-radius: 20px; margin-left:0px; margin-right:0px;">
									<h4><i class="fa fa-camera"></i><b> SECURITY SYSTEMS</b></h4>
									<p>Security systems, Security Cameras and CCTV monitoring.</p>
									</div>
								</a>
								<div class="x_title">
                                
                                <div class="clearfix"></div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
				
	  </div>
	  </div>
	<div>
      <?php include '../partPage/footer.html' ?>
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
      <!-- Chart.js -->
      <script src="../../resource/js/Chart.min.js"></script>
      <!-- gauge.js -->
      <script src="../../resource/js/gauge.min.js"></script>
      <!-- bootstrap-progressbar -->
      <script src="../../resource/js/bootstrap-progressbar.min.js"></script>
      <!-- iCheck -->
      <script src="../../resource/js/icheck.min.js"></script>
      <!-- Skycons -->
      <script src="../../resource/js/skycons.js"></script>
      <!-- Flot -->
      <script src="../../resource/js/jquery.flot.js"></script>
      <script src="../../resource/js/jquery.flot.pie.js"></script>
      <script src="../../resource/js/jquery.flot.time.js"></script>
      <script src="../../resource/js/jquery.flot.stack.js"></script>
      <script src="../../resource/js/jquery.flot.resize.js"></script>
      <!-- Flot plugins -->
      <script src="../../resource/js/jquery.flot.orderBars.js"></script>
      <script src="../../resource/js/jquery.flot.spline.min.js"></script>
      <script src="../../resource/js/curvedLines.js"></script>
      <!-- DateJS -->
      <script src="../../resource/js/date.js"></script>
      <!-- JQVMap -->
      <script src="../../resource/js/jquery.vmap.min.js"></script>
      <script src="../../resource/js/jquery.vmap.world.js"></script>
      <script src="../../resource/js/jquery.vmap.sampledata.js"></script>
      <!-- bootstrap-daterangepicker -->
      <script src="../../resource/js/moment.min.js"></script>
      <script src="../../resource/js/daterangepicker.js"></script>
      <!-- Custom Theme Scripts -->
      <script src="../../resource/js/custom.min.js"></script>

</body>
</html>
