<?php

session_start();

if(!isset($_SESSION['user_email']) ) {
    header("Location:../../index.php");
}
if(strcmp($_SESSION['user_type'], "customers") ) {
    header("Location:../../index.php");
}
include '../../src/common/DBConnection.php';

$conn=new DBConnection();

$CID=$_SESSION['user_id'];

$events=$conn->getAll(" SELECT service_list.ID, services.type, service_list.Date,
						service_list.Time,service_list.location,service_list.description ,service_list.state 
						FROM service_list,services 
						WHERE service_list.customer_ID='$CID' 
						AND service_list.service_ID=services.id
						AND service_list.state ='finished'
						AND service_list.Rating IS NULL;");


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
	<link href="../../resource/css/rate.css" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">

        <!-- side and top bar include -->
        <?php include '../partPage/sideAndTopBarMenucustomer.html' ?>
        <!-- /side and top bar include -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">

                <div class="page-title">
                    <div class="title_left">
                        <h3>Rate Service</small></h3>
                    </div>

                </div>

                

                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
							<div class="x_title">
                                <h2>Services List</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
								
                                <table class="table table-striped table-bordered" id="cTable" name="cTable" style="width:100%" >
                                    <thead>
                                    <tr>
										<th><center>Service Type</center></th>
                                        <th><center>Service Date</center></th>
                                        <th><center>Service Time</center></th>
                                        <th><center>Description</center></th>
										<th><center>Location</center></th>
                                        <th><center>Status</center></th>
                                        <th><center>Rate Service</center></th>
										<th><center></center></th>
                                    </tr>
                                    </thead>
									
                                    <tbody>
                                    <?php
                                    foreach ($events as $event){
                                        ?>
										
                                        <tr id="myRow" name="myRow"  >
                                            <td><center><?=$event['type']?></center></td>
											<td><center><?=$event['Date']?></center></td>
                                            <td><center><?=$event['Time']?></center></td>
                                            <td><center><?=$event['description']?></center></td>
                                            <td><center><?=$event['location']?></center></td>
                                            <td><center><?=$event['state']?></center></td>
											<form action="../../src/store/rateService.php" method="post">
											<input type="hidden" id="ID" name="ID" value="<?=(int)$event['ID']?>"> 
                                            <td><select class="form-control" style="text-align-last:center;" name="select_catalog" id="select_catalog">
												<option value="1"><center>1 - Bad</center></option>
												<option value="2">2 - Weak</option>
												<option value="3">3 - Average</option>
												<option value="4">4 - Very Good</option>
												<option value="5">5 - Excellent</option>
											</select>
											</td>	
											<td><center><button class="form-control green" type="submit" id ="rate" name ="rate"><i class="fa fa-check"></i></button></center></td>
                                            </form>
										</tr>
										
                                        <?php
                                        //../../src/store/disalbeReservation.php
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
</body>
</html>
