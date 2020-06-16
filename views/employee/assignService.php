<?php


session_start();

if(!isset($_SESSION['user_email'])) {
    header("Location:../../index.php");
}
if(strcmp($_SESSION['user_type'], "employees") ) {
    header("Location:../../index.php");
}

include '../../src/common/DBConnection.php';

$conn=new DBConnection();

$notices=$conn->getAll("SELECT service_list.*,services.type FROM service_list INNER JOIN services ON service_list.service_ID = services.id  WHERE state='pending'");

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
    <!-- Custom Theme Style -->
    <link href="../../resource/css/custom.css" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">

        <!-- side and top bar include -->
        <?php include '../partPage/sideAndTopBarMenuEmployee.html' ?>
        <!-- /side and top bar include -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Assign Services</h3>
                    </div>

                </div>
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <!-- first Div -->
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>View Requested Services</h2>
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
                                <?php if(isset($_GET['error'])){
                                        echo "<div class='alert alert-danger' role='alert'>".
                                        $_GET['error']
                                        ."</div>";
                                        }else if(isset($_GET['msg'])){
                                            echo "<div class='alert alert-success' role='alert'>".
                                            $_GET['msg']
                                            ."</div>";
                                        }?>

                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th><center>Service ID</center></th>
                                        <th><center>Date</center></th>
                                        <th><center>Time</center></th>
										<th><center>Type</center></th>
                                        <th><center>state</center></th>
                                        <th><center>Created At</center></th>
                                        <th><center>Actions</center></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($notices as $notice){
                                        ?>
                                        <tr>
                                            <td><center><?=$notice['ID']?></center></td>
                                            <td><center><?=$notice['Date']?></center></td>
                                            <td><center><?=$notice['Time']?></center></td>
											<td><center><?=$notice['type']?></center></td>
                                            <td><center><?=$notice['state']?></center></td>
                                            <td><center><?=$notice['time_created']?></center></td>
                                            <td><center>
                                            <button class="btn btn-success btnassign" id="btnassign">Assign</button>
                                            </center></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End first Div -->
                        <!-- second Div -->
                        <div class="x_panel">
                            <h2>View avalible Contractor</h2>
                            <div class="x_title">
                            </div>
                            <div class="x_content">
                                <form action=""> 
                                        <select class="form-control" name="Date" onchange="showCustomer(this.value)">

                                            <option value="">Select a Time and Date:</option>
                                            <?php
                                                foreach ($notices as $notice){
                                            ?>
                                            <option value="<?=$notice['Date'].' '.$notice['Time']?>"><?=$notice['Date'].' '.$notice['Time']?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                </form>
                                <div id="txtHint"></div>
                            </div>
                        </div>
                        <!-- End second Div -->
                        
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
<!-- Start Of Model-->
<div class="modal fade" tabindex="-1" id="assignModal" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title">Assign Contractor</h4>
            </div>
            <div class="modal-body">
                <form class="form" action="../../src/store/assignContractor.php" method="post" id="registrationForm">
                <div class="form-group">
                    <div class="col-xs-12">
                        <h4>Enter Contractor ID:</h4>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="hidden" name="service_ID" id="service_ID">
                        <input type="hidden" name="date" id="date">
                        <input type="hidden" name="time" id="time">
                        <input type="text" class="form-control" id="contractor_ID" name="contractor_ID" placeholder="Enter ID" required>
                    </div>
                </div>                                            
                <div class="form-group">
                    <div class="col-xs-12 col-md-offset-4">
                        <br>
                        <button type="reset" class="btn btn-primary">Reset</button>
                        <button name="btn-notice" id="btn-notice" type="submit" class="btn btn-success">Save</button>
                    </div>
            </div>
        </form>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
<!-- End of Model -->
<script>
function showCustomer(str) {
  var xhttp;  
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "../../src/store/getContractor.php?date="+str, true);
  xhttp.send();
}
</script>
<!-- jQuery -->
<script src="../../resource/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../../resource/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../resource/js/fastclick.js"></script>
<!-- NProgress -->
<script src="../../resource/js/nprogress.js"></script>
<!-- validator -->
<script src="../../resource/js/validator.js"></script>
<!-- Custom Theme Scripts -->
<script src="../../resource/js/custom.min.js"></script>
<script src="../../resource/js/model.ae.js"></script>
</body>
</html>
