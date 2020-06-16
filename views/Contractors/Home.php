<?php

session_start();

if(!isset($_SESSION['user_email']) ) {
		header("Location:../../index.php");
}
if(strcmp($_SESSION['user_type'], "contractors") ) {
    header("Location:../../index.php");
}

include ("../../src/common/DBConnection.php");

$conn=new DBConnection();

$CID=$_SESSION['user_id'];

$pendingService = $conn-> getAll(" SELECT * FROM service_list INNER JOIN contractors ON service_list.contractor_ID = contractors.id WHERE service_list.contractor_ID = '$CID' AND service_list.state = 'pending' ");

$liveService = $conn-> getAll(" SELECT * FROM service_list INNER JOIN contractors ON service_list.contractor_ID = contractors.id WHERE service_list.contractor_ID = '$CID' AND service_list.state = 'live' ");

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

$events=$conn->getAll(" SELECT service_list.*
						FROM service_list 
						WHERE service_list.contractor_ID = '$CID' AND service_list.state = 'pending' ");
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
    <!-- bootstrap-progressbar -->
    <link href="../../resource/css/bootstrap-progressbar-3.3.4.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../../resource/css/jqvmap.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../../resource/css/daterangepicker.css" rel="stylesheet">
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
        <div class="right_col" role="main" style="background-image: url('../../resource/images/bg.png');">
          <!-- top tiles -->
            <div class="row tile_count">
                <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-clock-o"></i> Total Pending Services</span>
                    <div class="count"><?=count($pendingService)?></div>
                    <span class="count_bottom"><i class="green">Pending</i> Services<span>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-play-circle-o"></i> Total Live Services</span>
                    <div class="count"><?=count($liveService)?></div>
                    <span class="count_bottom"><i class="green">Active</i> Services<span>
                </div>
				<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-check-square-o"></i> Total Finished Services</span>
                    <div class="count"><?=count($finishedService)?></div>
                    <span class="count_bottom"><i class="green">Finished</i> Services<span>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-thumbs-o-up"></i> Rating</span>
                    <div class="count green"><?=($finalRate) ?>/5</div>
                    <span class="count_bottom"><i class="green">Happy</i> Customers<span>
                </div>
            </div>
            <!-- /top tiles -->
			<?php
				if(strcmp($_SESSION['conState'], "verified") == 0 ) {
			?>
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Accept <small>Services</small></h3>
                    </div>

                </div>

                <div class="clearfix"></div>

                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Requests You have</h2>
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

                                <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th><center>Service Date</center></th>
                                        <th><center>Service Time</center></th>
									    <th><center>Location</center></th>
										<th><center>Description</center></th>
                                        <th><center>Status</center></th>
                                        <th><center>Actions</center></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($events as $event){
                                        ?>
                                        <tr>
										<form method="post" action="cancelPending.php" onsubmit="return confirm('Are you sure you want to accept this service ? press OK to continue.'); ">
                                            <td><center><?= $event['Date']?></center></td>
                                            <td><center><?= $event['Time']?></center></td>
                                            <td><center><?= $event['location']?></center></td>
                                            <td><center><?= $event['description']?></center></td>
											<td><center><?= $event['state']?></center></td>
											<input type="hidden" name="id" name="id" value="<?=(int)$event['ID']?>">
											<td><center><input class="btn btn-success" type ="submit" id ="cancel" name =" accept " value ="Accept"></center></td>
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
			<?php
				}else{
			?>
			<div class="">
                <div class="page-title">
					<h4>Dear Contractor,</h4>
					<h4>Your functionalities are limited because your status is still <i class="green">pending</i>, once you become <i class="green">verified</i>, you can access all your functionalities.</h4>
					<h4>Thank you for your understanding.</h4>	
                </div>
			</div>
			<?php
				}
			?>
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
