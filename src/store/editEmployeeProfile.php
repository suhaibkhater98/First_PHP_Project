<?php
session_start();

include '../../src/common/checkEmail.php';
include '../../src/common/DBConnection.php';

$conn=new DBConnection();

$user_id = $_SESSION['user_id'];
$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = trim($_POST['password']);
$salt = "qservice";
echo $password."<br>";
echo sha1($password)."<br>";
$hashpassword = sha1($password.$salt);
echo $hashpassword;
$check = check_Email($email,$phone);
if($check){
	$query = "UPDATE employees SET fname='$fname',lname='$lname',phone='$phone',email='$email',password='$hashpassword' WHERE id='$user_id' ";

	$result = $conn->execute($query);

	if ($result ){
	  header("location: ../../views/employee/employeeProfile.php?msg=Succussfully edit you information");
	}
	else{
	  header("location: ../../views/employee/employeeProfile.php?error=Unsuccussfully edit you information");
	}
}else{
	header("location: ../../views/employee/employeeProfile.php?error=Email or Phone in used");
}

?>