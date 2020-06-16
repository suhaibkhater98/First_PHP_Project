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
if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM info WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$name = $n['name'];
			$address = $n['address'];
		}
}
$CID=$_SESSION['user_id'];

$events=$conn->getAll(" SELECT service_list.*,services.type,customers.fname,customers.lname 
						FROM service_list INNER JOIN services ON service_list.service_ID = services.id 
						INNER JOIN customers ON service_list.customer_ID = customers.id 
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

                <div class="page-title">
                    <div class="title_left">
                        <h3>Cancel <small>Reservation</small></h3>
                    </div>

                </div>

                <div class="clearfix"></div>

                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>View Services</h2>
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
										<th><center>Service Type</center></th>
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
										<form method="post" action="../../src/store/cancelResContractor.php" onsubmit="return confirm('Are you sure you want to cancel this service ? press OK to continue.'); ">
                                            <td><center><?=$event['type']?></center></td>
											<td><center><?=$event['Date']?></center></td>
                                            <td><center><?=$event['Time']?></center></td>
                                            <td><center><?=$event['location']?></center></td>
                                            <td><center><?=$event['description']?></center></td>
                                            <td><center><?=$event['state']?></center></td>
											<input type="hidden" name="id" name="id" value="<?=(int)$event['ID']?>">
											<td><center><input class="btn btn-success" type ="submit" id ="cancel" name ="Cancel" value ="Cancel" onClick=isSure()></center></td>
                                        </form>
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
</body>
</html>