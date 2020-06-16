<?php


session_start();

if(!isset($_SESSION['user_email'])) {
    header("Location:../../index.php");
}
if(strcmp($_SESSION['user_type'], "employees") ) {
    header("Location:../../index.php");
}

//include '../../src/common/DBConnection.php';
//
//$conn=new DBConnection();
//
//print_r($conn->getAll("SELECT * FROM `notices`"));

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
                        <h5>
                            <?php
                            if(!empty($_GET['message'])) {
                                if($_GET['message']=="success") {
                                    echo "<div class=\"alert alert-success fade in alert-dismissable\">
                                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a>
                                    Notice Successfully Send To Notice Board
                                    </div>";
                                } else if($_GET['message']=="failed") {
                                    echo "<div class=\"alert alert-danger fade in alert-dismissable\">
                                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a>
                                    Notice Send To Notice Board Unfortunately Failed, Please Try Again Later
                                    </div>";
                                }
                            }
                            ?>
                        </h5>
                        <h3>Add <small>New Service</small></h3>
                    </div>

                </div>
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Provide New Service Information</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
							
                            <div class="x_content">
							<p class="text-muted font-13 m-b-30"></p>
                                <form action="../../src/store/createService.php" method="post" class="form-horizontal form-label-left" novalidate>
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
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="noticeSubject">Service Type <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="noticeSubject" class="form-control col-md-7 col-xs-12" data-validate-minmax="5,20" name="service_type" placeholder="Service Type" required="required" type="text">
                                        </div>
                                    </div>


                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="noticeDesc">Service Description<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea rows="5" id="noticeDesc" name="serviceDesc" required="required" placeholder="Service Description" class="form-control col-md-7 col-xs-12"></textarea>
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-5">
                                            <button type="reset" class="btn btn-primary">Reset</button>
                                            <button name="btn-notice" id="btn-notice" type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </form>
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
<!-- validator -->
<script src="../../resource/js/validator.js"></script>
<!-- Custom Theme Scripts -->
<script src="../../resource/js/custom.min.js"></script>
</body>
</html>
