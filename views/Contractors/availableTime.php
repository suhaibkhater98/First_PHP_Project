<?php

session_start();

if(!isset($_SESSION['user_email']) ) {
    header("Location:../../index.php");
}
if(strcmp($_SESSION['user_type'], "contractors") ) {
    header("Location:../../index.php");
}
if(strcmp($_SESSION['conState'], "verified")) {
    header("Location:Home.php");
}
include '../../src/common/DBConnection.php';

$conn=new DBConnection();
$CID=$_SESSION['user_id'];
$events=$conn->getAll(" SELECT availability.*
						FROM availability INNER JOIN contractors ON availability.contractor_id = contractors.id 
						WHERE availability.contractor_id = '$CID' ");

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
	<!-- Modal -->
    <link href="../../resource/css/modal.css" rel="stylesheet">
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

                <div class="page-title">
                    <div class="title_left">
                        <h3>View <small>Availability</small></h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Available Time List</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <p class="text-muted font-13 m-b-30">

                                </p>

                                <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th><center>Date Available</center></th>
                                        <th><center>Available From</center></th>
                                        <th><center>Available To</center></th>
                                        <th><center>Actions</center></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($events as $event){
                                    ?>
                                    <tr>
                                        <td><center><?=$event['date']?></center></td>
                                        <td><center><?=$event['available_from']?></center></td>
                                        <td><center><?=$event['available_to']?></center></td>
                                        <td><center><input class="btn btn-success" type ="submit" id ="myBtn" name ="Edit" value ="Edit"></center></td>
										
										<!-- The Modal -->
										<div id="myModal" class="modal">

										<!-- Modal content -->
										<div class="modal-content">
											<span class="close">&times;</span>
										
											<form class="form" action="../../src/store/editAvailability.php" method="post" id="registrationForm">
											
												<div class="form-group">
                          
													<div class="col-xs-12">
														<label for="available-Date"><h4>Available Date</h4></label>
														<input type="date" data-date="" data-date-format="YYYY MM DD" data-validate-length-range="6" data-validate-words="2" class="form-control" name="available-Date" id="available-Date" placeholder="Enter Available Date" required>
													</div>
												</div>
												<div class="form-group">
													<div class="col-xs-12">
														<label for="available_From"><h4>Available From*</h4></label>
														<input type="time" class="form-control" name="available_From" id="available_From" placeholder="Available From" required>
													</div>
												</div>

												<div class="form-group">
													<div class="col-xs-12">
														<label for="available_to"><h4>Available To*</h4></label>
														<input type="time" class="form-control" name="available_to" id="available_to" placeholder="Available To" required>
													</div>
												</div>
												
												<div class="form-group">
													<div class="col-xs-12 col-md-offset-4">
														<br>
														<button type="reset" class="btn btn-primary">Reset</button>
														<button name="btn-notice" id="btn-notice" type="submit" class="btn btn-success">Save</button>
													</div>
												</div>
												<input type="hidden" name="id" name="id" value="<?=(int)$event['ID']?>">
											</form>
										</div>
										</div>
									</tr>
                                    <?php
                                   }
                                    ?>
                                    </tbody>
                                </table>
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
<!-- Modal -->
<script src="../../resource/js/modal.js"></script>
</body>
</html>
