<?php


session_start();

if(!isset($_SESSION['user_email'])) {
    header("Location:../../index.php");
}
if(strcmp($_SESSION['user_type'], "admins") ) {
    header("Location:../../index.php");
}
include '../../src/common/DBConnection.php';

$conn=new DBConnection();

$events = $conn->getAll(
    "SELECT id,fname,lname,type,email,phone,state from customers WHERE state='active'
    UNION 
    SELECT id,fname,lname,type,email,phone,state from contractors WHERE state='verified'");
$events2 = $conn->getAll(
    "SELECT id,fname,lname,type,email,phone,state from customers WHERE state='blocked'
    UNION 
    SELECT id,fname,lname,type,email,phone,state from contractors WHERE state='blocked'");
	
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
        <?php include '../partPage/sideAndTopBarMenu.html' ?>
        <!-- /side and top bar include -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">

                <div class="page-title">
                    <div class="title_left">
                        <h3>Block <small>User</small></h3>
                    </div>

                    
                </div>

                <div class="clearfix"></div>

                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Manage Users</h2>
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

                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th><center>ID</center></th>
                                        <th><center>Type</center></th>
                                        <th><center>First Name</center></th>
                                        <th><center>Last Name</center></th>
										<th><center>Email</center></th>
										<th><center>Phone</center></th>
										<th><center>State</center></th>
                                        <th><center>Actions</center></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($events as $event){
                                    ?>
                                    <tr>
                                        <td><center><?=$event['id']?></center></td>
                                        <td><center><?=$event['type']?></center></td>
                                        <td><center><?=$event['fname']?></center></td>
                                        <td><center><?=$event['lname']?></center></td>
                                        <td><center><?=$event['email']?></center></td>
                                        <td><center><?=$event['phone']?></center></td>
										<td><center><?=$event['state']?></center></td>
										<td><center><a onclick="return confirm('Are you sure you want to block this user? press OK to continue.');" href="../../src/store/disableUser.php? id=<?=$event['id']?> & type=<?=$event['type']?>" class="green">Block User</a></center></td>
                                    </tr>
                                    <?php
                                   }
                                    ?>
                                    <?php
                                    foreach ($events2 as $event){
                                    ?>
                                    <tr>
                                        <td><center><?=$event['id']?></center></td>
                                        <td><center><?=$event['type']?></center></td>
                                        <td><center><?=$event['fname']?></center></td>
                                        <td><center><?=$event['lname']?></center></td>
                                        <td><center><?=$event['email']?></center></td>
                                        <td><center><?=$event['phone']?></center></td>
										<td><center><?=$event['state']?></center></td>
										<td><center><a onclick="return confirm('Are you sure you want to unblock this user? press OK to continue.');" href="../../src/store/unblockUser.php? id=<?=$event['id']?> & type=<?=$event['type']?>" class="green">Unblock User</a></center></td>
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
