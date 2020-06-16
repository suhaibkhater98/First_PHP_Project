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

$conn = new DBConnection();

$CID=$_SESSION['user_id'];

$events=$conn->getAll(" SELECT service_list.*,services.type,customers.fname,customers.lname, customers.phone 
						FROM service_list INNER JOIN services ON service_list.service_ID = services.id 
						INNER JOIN customers ON service_list.customer_ID = customers.id 
						WHERE service_list.contractor_ID = '$CID' AND service_list.state = 'live' ");

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
                        <h3>Live <small>Services</small></h3>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Live Services List</h2>
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
                                        <th><center>Service Type</center></th>
										<th><center>Service Date</center></th>
										<th><center>Service Time</center></th>
										<th><center>Location</center></th>
                                        <th><center>Customer</center></th>
										<th><center>Phone Number</center></th>
                                        <th><center>Status</center></th>
										<th><center>Actions</center></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                     
                                    foreach ($events as $event){  
                                    ?>
                                    <tr>  
                                        <td><center><?=$event['type']?></center></td>
                                        <td><center><?=$event['Date']?></center></td>
                                        <td><center><?=$event['Time']?></center></td>
										<td><center><?=$event['location']?></center></td>
										<td><center><?=$event['fname']?> <?=$event['lname']?></center></td>
										<td><center><?=$event['phone']?></center></td>
                                        <td><center><?=$event['state']?></center></td>
                                        <td><center><button class="btn btn-success editbtnn" id=<?=$event['ID']?>>Finish</button></td>
									</tr>
                                    <?php
                                   }
                                    ?>
                                    </tbody>
                                </table>
                            <!-- Start Of Model-->
                                <div class="modal fade" tabindex="-1" id="loginModal" data-keyboard="false">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                    &times;
                                                </button>
                                                <h4 class="modal-title">Finish Live Service</h4>
                                            </div>
                                            <div class="modal-body">

                                            <form class="form" action="../../src/store/editLiveService.php" method="post" id="registrationForm">
                                            <div class="form-group">
													<div class="col-xs-12">
														<label for="service-Cost"><h4>Service Cost*</h4></label>
														<input type="text" class="form-control" name="service-Cost" id="service-Cost" placeholder="Enter Service Cost" title="Enter Service Cost" required>
													</div>
												</div>
												<div class="form-group">
													<div class="col-xs-12">
														<label for="service_State"><h4>Service State*</h4></label>
														<input type="text" class="form-control" name="service_State" id="service_State" placeholder="Finished" title="Service State" disabled="true">
													</div>
												</div>

												<div class="form-group">
													<div class="col-xs-12">
														<label for="serDesc"><h4>Description*</h4></label>
														<textarea style="resize: none;" rows="2" id="serDesc" name="serDesc" required="required" placeholder="Service Description" class="form-control col-xs-12" required></textarea>
													</div>
												</div>                                          
                                            <div class="form-group">
                                                <div class="col-xs-12 col-md-offset-4">
                                                    <br>
                                                    <button type="reset" class="btn btn-primary">Reset</button>
                                                    <button name="btn-notice" id="btn-notice" type="submit" class="btn btn-success">Save</button>
                                                </div>
                                            </div>
                                                    <input type="hidden" id="serviceId" name="serviceId">
                                        </form>
                                        
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Model -->
                            </div>
                            
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
<!-- Custom Theme Scripts -->
<script src="../../resource/js/custom.min.js"></script>
<script src="../../resource/js/editModal.js"></script>
</body>
</html>