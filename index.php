<?php
session_start();
include_once ('src/common/DBConnection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QService</title>
    <!-- Bootstrap -->
    <link href="resource/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="resource/css/font-awesome.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="resource/css/animate.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="resource/css/custom.css" rel="stylesheet">
	<!-- Show and Hide -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form action="src/store/Login.php" method="post">
                    <h1>Login to your Account</h1>
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
                    <div>
                        <input type="text" id="userName" name="userName" class="form-control" placeholder="Username" required />
                    </div>
                    <div>
                        <input type="password" id="pwd" name="password" class="form-control" placeholder="Password" required />
                    </div>
                    <div>
                        <select name="usertype" id="userType" class="form-control">
                            <option value="admins">Admin</option>
                            <option value="employees">Employee</option>
                            <option value="contractors">Contractor</option>
                            <option value="customers">Customer</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <button type="submit" name="login" class="btn btn-default submit">Log in</button>                        
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">New to site?
                            <a href="index.php#signup" class="to_register"> Create Account </a>
                        </p>
                        <div class="clearfix"></div>
                        <br/>

                        <div>
                            <h1><i class="fa fa-group"></i> QService</h1>
                            <p>© 2020 All Rights Reserved. QService Group</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>


		<div id="signup" class="animate form registration_form">
            <section class="login_content">
                <form id="example7" action="src/store/signUp.php" method="post">
                    <h1>Signup</h1>
                    <div>
                        <input type="text" name="fname" class="form-control" placeholder="First Name" required/>
                    </div>
                    <div>
                        <input type="text" name="lname" class="form-control" placeholder="Last Name" required/>
                    </div>
                    <div>
                        <input type="email" name="email" class="form-control" placeholder="Email" required/>
                    </div>
                    <div>
                        <input type="password"  id="password" name="password" class="form-control" placeholder="Password" onchange="form.pwd2.pattern = this.value;" minlength="6" required />
                    </div>
                    <div>
                        <input type="password" name="pwd2" class="form-control" placeholder="Re-enter Password"  title="Please enter the same Password as above" required/>
                    </div>
                    <div>
                        <input type="text" name="phone" class="form-control" placeholder="Phone" required />
                    </div>
					<div>
						<select name="choose" id="choose" class="form-control">
							<option value="customer">Customer</option>
							<option value="contractor">Contractor</option>
						</select>
					</div>
					<br>
					<div>
						<select name="typeChoose" id="typeChoose" class="form-control" style="display:none;">
                            <option value="ELECTRICITY">Electricity</option>
                            <option value="PLUMBING">Plumbing</option>
							<option value="SATELLITE">Satellite</option>
							<option value="GARDENING">Gardening & Landscaping</option>
                            <option value="AIR CONDITIONING">Air Conditioning</option>
							<option value="REMODELING">Remodeling & Constructions</option>
							<option value="HEATING">Heating</option>
                            <option value="PAINTING">Painting & Interior</option>
							<option value="SECURITY">Security Systems</option>
                        </select>
					</div>
					<br>
                    <div>
                        <button type="reset" class="btn btn-primary">Reset</button>
                        <button type="submit" name="signUp" class="btn btn btn-success">Submit</button>
                    </div>
                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="index.php#signin" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br/>

                        <div>
                            <h1><i class="fa fa-group"></i> QService</h1>
                            <p>© 2020 All Rights Reserved. QService Group</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $("#choose").on("change", function() {
        if ($(this).val() === "contractor") {
            $("#typeChoose").show();
        }
        else {
            $("#typeChoose").hide();
        }
    });
});
</script>
</body>
</html>
