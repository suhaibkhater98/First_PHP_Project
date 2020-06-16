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
if (isset($_GET['service-type']) ){
  $_SESSION['type'] = $_GET['service-type'];
}
else {
$_SESSION['type']=0;
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
      <!-- page content -->
      <div class="right_col" role="main">
          <div class="">
              <div class="page-title">
                  <div class="title_left">
                      <h3>Request <small>Service</small></h3>
                  </div>
              </div>

              <div class="clearfix"></div>

              <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_panel">
                          <div class="x_title">
                              <h2>Provide Service Information Below!</h2>
                              <div class="clearfix"></div>
                          </div>
						<div class="x_content">
						<p class="text-muted font-13 m-b-30"></p>
						<form class="form-horizontal form-label-left"  method="post" action="../../src/store/makeService.php">
									<div class="item form-group" >
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type" >Service Type <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control col-md-7 col-xs-12" required name="select_catalog" id="select_catalog">
												<option value="PLUMBING" <?php if($_SESSION['type'] == "PLUMBING") echo "selected";?> >Plumping</option>
												<option value="ELECTRICITY"<?php if($_SESSION['type'] == "ELECTRICITY") echo "selected";?> >Electricity</option>
												<option value="SATELLITE" <?php if($_SESSION['type'] == "SATELLITE") echo "selected";?>>Satellite</option>
												<option value="GARDENING & LANDSCAPING" <?php if($_SESSION['type'] == "GARDENING") echo "selected";?>>Gardening & Landscaping</option>
												<option value="AIR CONDITIONING" <?php if($_SESSION['type'] == "AIR") echo "selected";?>>Air Conditioning</option>
												<option value="REMODELING & CONSTRUCTIONS" <?php if($_SESSION['type'] == "REMODELING") echo "selected";?>>Remodeling & Constructions</option>
												<option value="HEATING" <?php if($_SESSION['type'] == "HEATING") echo "selected";?>>Heating</option>
												<option value="PAINTING & INTERIOR" <?php if($_SESSION['type'] == "PAINTING")echo "selected";?>>Painting & Interior</option>
												<option value="SECURITY SYSTEMS" <?php if($_SESSION['type'] == "SECURITY")echo "selected";?>>Security Systems</option>
											</select>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="eventDate">Select Date <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
											
                                            <input id="eventDate" name="eventDate" required class="form-control col-md-7 col-xs-12" min="" max=""  data-validate-length-range="6" data-validate-words="2" name="eventDate" placeholder="Event Date" required="required" type="date">
											<script>
											    
												getElementById("eventDate").validate();
											</script>
										</div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="eventTime">Select Time <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="time" required id="eventTime" name="eventTime" required="required" placeholder="Event Time" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
									<div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="location">Location <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="location" required class="form-control col-md-7 col-xs-12" data-validate-minmax="10,20" name="location" placeholder="Provide Location"  type="text">
                                        </div>
                                    </div>

									<div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="eventDesc">Service Description</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea rows="5"  id="eventDesc" name="eventDesc"  placeholder="Service Description" class="form-control col-md-7 col-xs-12"></textarea>
                                        </div>
                                    </div>
									<div class="col-md-6 col-md-offset-5">
                                            <button type="reset" value="Reset" class="btn btn-primary">Reset</button>
											
                                            <button id="send" type="submit" class="btn btn-success" >Submit</button>
											
											
									   </div>
									
                                </form>
            
								</div>
							</div>
						</div>
                  </div>
              </div>
          </div>
      </div>
      <!-- /page content -->
      <?php include '../partPage/footer.html' ?>
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
