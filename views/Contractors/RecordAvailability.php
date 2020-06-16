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
                        <h3>Record <small>Availability</small></h3>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Record Your Availability</h2>
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
                                <form class="form-horizontal form-label-left" action="../../src/store/insertAvailability.php" method="post" novalidate>
                                <?php if(isset($_GET['error'])){
                                        echo "<div class='alert alert-danger' role='alert'>".
                                        $_GET['error']
                                        ."</div>";
                                        }else if(isset($_GET['msg'])){
                                            echo "<div class='alert alert-success' role='alert'>".
                                            $_GET['msg']
                                            ."</div>";
                                        }?>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="eventDate">Select Date <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="eventDate" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="eventDate" placeholder="Event Date" required="required" type="date">
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="eventTime">Available From <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="time" id="eventTime" name="eventTime" required="required" placeholder="Event Time" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
									<div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="eventTime2">Available To <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="time" id="eventTime2" name="eventTime2" required="required" placeholder="Event Time" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-5">
                                            <button type="reset" value="Reset" class="btn btn-primary">Reset</button>
                                            <button id="send" type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
									</form>
                            </div>
                        </div>
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
                                        <td><center id="date"><?=$event['date']?></center></td>
                                        <td><center id="from"><?=$event['available_from']?></center></td>
                                        <td><center id="to"><?=$event['available_to']?></center></td>
                                        <td><center><button class="btn btn-success editbtn" id=<?=$event['id']?>>Edit</button>
                                        <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this time? press OK to continue.');"
                                        href="../../src/store/deleteTime.php?id=<?=$event['id']?>&date=<?=$event['date']?>&from=<?=$event['available_from']?>&to=<?=$event['available_to']?>">
                                        Delete</a></center></td>
										
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
                                                <h4 class="modal-title">Edit Time</h4>
                                            </div>
                                            <div class="modal-body">

                                            <form class="form" action="../../src/store/editAvailability.php" method="post" id="registrationForm">
                                            <div class="form-group">
                                                <div class="col-xs-12">
                                                    <label for="available-Datee"><h4>Available Date</h4></label>
                                                    <input type="date" data-date-format="YYYY MM DD" data-validate-length-range="6" data-validate-words="2" class="form-control" name="available_Datee" id="available_Datee" placeholder="Enter Available Date" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-xs-12">
                                                    <label for="available_fromm"><h4>Available From*</h4></label>
                                                    <input type="time" class="form-control" name="available_fromm" id="available_fromm" placeholder="Available From" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-xs-12">
                                                    <label for="available_too"><h4>Available To*</h4></label>
                                                    <input type="time" class="form-control" name="available_too" id="available_too" placeholder="Available To" required>
                                                </div>
                                            </div>                                            
                                            <div class="form-group">
                                                <div class="col-xs-12 col-md-offset-4">
                                                    <br>
                                                    <button type="reset" class="btn btn-primary">Reset</button>
                                                    <button name="btn-notice" id="btn-notice" type="submit" class="btn btn-success">Save</button>
                                                </div>
                                            </div>
                                                    <input type="hidden" id="dateId" name="dateId">
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
<script src="../../resource/js/modal.js"></script>
<script src="../../resource/js/modal.ae.js"></script>
</body>
</html>