<?php

session_start();

if(!isset($_SESSION['user_email']) ) {
    header("Location:../../index.php");
}

include '../../src/common/DBConnection.php';

$conn=new DBConnection();
$CID=$_SESSION['user_id'];
$info=$conn->getOne("SELECT * FROM customers WHERE id = '$CID'");

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
        <?php include '../partPage/sideAndTopBarMenuCustomer.html' ?>
        <!-- /side and top bar include -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">


                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                                
                            <div class="x_content">
							<p class="text-muted font-13 m-b-30"></p>
							
					<div class="container bootstrap snippet">
						<div class="row">
							<div class="col-sm-10"><h1><?php echo$_SESSION['fname']." ".$_SESSION['lname'];?></h1></div>
							</div>
						<hr>
						<div class="row">
							<div class="col-sm-3"><!--left col-->
								<div class="text-center">
								<div class="profile_pic" style="width:100%; padding:10px;">
								<img src="../../resource/images/user.png" alt="..." class="img-circle profile_img"style="margin: auto;">
								</div>
								<h5>Addtional Information</h5>
						</div><hr><br>

          <div class="panel panel-default">
            <div class="panel-heading" style="text-align: center;">Social Media</div>
            <div class="panel-body" style="text-align: center;">
            	<i class="fa fa-facebook fa-2x"></i></i> <i class="fa fa-twitter fa-2x"></i><i class="fa fa-google-plus fa-2x"></i>
            </div>
          </div>
          
        </div><!--/col-3-->
    	<div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Information</a></li>
              </ul>

              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>
                  <form class="form" action="../../src/store/editCustomerProfile.php" method="post" id="registrationForm">
                        <?php if(isset($_GET['error'])){
                        echo "<div class='alert alert-danger' role='alert'>".
                        $_GET['error']
                        ."</div>";
                        }
                        if(isset($_GET['msg'])){
                            echo "<div class='alert alert-success' role='alert'>".
                            $_GET['msg']
                            ."</div>";
                        }
                        ?>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="first_name"><h4>First name</h4></label>
                              <input type="text" class="form-control" name="first_name" id="first_name" value="<?=($info['fname']) ?>" title="enter your first name if any.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="last_name"><h4>Last name</h4></label>
                              <input type="text" class="form-control" name="last_name" id="last_name" value="<?=($info['lname']) ?>" title="enter your last name if any.">
                          </div>
                      </div>
          
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="phone"><h4>Phone</h4></label>
                              <input type="text" class="form-control" name="phone" id="phone" value="<?=($info['phone']) ?>" title="enter your phone number if any." >
                          </div>
                      </div>
          
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Email</h4></label>
                              <input type="email" class="form-control" name="email" id="email" value="<?=($info['email']) ?>" title="enter your email.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="state"><h4>State</h4></label>
                              <input type="text" class="form-control" name="state" id="email" value="<?=($info['state']) ?>">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Location</h4></label>
                              <input type="text" class="form-control" name="location" id="location" value="<?=($info['location']) ?>" title="enter your email.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="password"><h4>Password</h4></label>
                              <input type="password" class="form-control" name="password" id="password" placeholder="Enter New Password" onchange="form.pwd2.pattern = this.value;" minlength="6" required>
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="password2"><h4>Verify Password</h4></label>
                              <input type="password" class="form-control" name="pwd2" id="password2" placeholder="Re-enter Password"  title="Passwords dose not match" required>
                          </div>
                      </div>
                      <div class="form-group">
                           <div class="col-xs-12 col-xs-6">
                                <br>
                              	<button type="reset" class="btn btn-primary">Reset</button>
                                <button name="btn-notice" id="btn-notice" type="submit" class="btn btn-success">Submit</button>
                            </div>
                      </div>
              	</form>
              </div>
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
							
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

</body>
</html>
