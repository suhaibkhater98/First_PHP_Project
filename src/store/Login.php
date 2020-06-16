<?php

session_start();

include_once ('../common/DBConnection.php');

$dbConnection = new DBConnection();

if (isset($_POST['login'])){
    $user_name = trim($_POST['userName']);
    $user_password = trim($_POST['password']);
    $user_type = $_POST['usertype'];
    $salt = "qservice";
    $hashpassword = sha1($user_password.$salt);
    echo $hashpassword;
    
    $restlt = $dbConnection->getOne("SELECT * FROM $user_type WHERE email='$user_name' AND password='$hashpassword' ");
    if ($restlt){
        $_SESSION['user_email'] = $restlt['email'];
        $_SESSION['fname'] = $restlt['fname'];
		$_SESSION['lname'] = $restlt['lname'];
        $_SESSION['user_id'] = $restlt['id'];
        $_SESSION['user_type'] = $user_type;

        if($user_type == 'admins'){
            header("Location:../../views/admin/dashboard.php");
        }if ($user_type == 'employees'){
            header("Location:../../views/employee/dashboard.php");
        }
        if($user_type == 'contractors'){
			$stateResult = $dbConnection->getOne("SELECT * FROM contractors WHERE email='$user_name' ");
			$_SESSION['conState'] = $stateResult['state'];
            header("Location:../../views/Contractors/Home.php");
        }
        if($user_type == 'customers'){
            header("Location:../../views/customer/dashboard.php");
        }
    }
    else{
        header("location:../../index.php?error=Wrong Email or Password");
    }
    
}
