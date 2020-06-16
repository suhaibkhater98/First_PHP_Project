<?php
session_start();
include_once('../../src/common/DBConnection.php');
include_once('../../src/common/checkEmail.php');
$conn=new DBConnection();

$user_id = $_SESSION['user_id'];

$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$conSpeciality = $_POST['speciality'];
$location = $_POST['location'];
$password = trim($_POST['password']);
$salt = "qservice";

$hashpassword = sha1($password.$salt);
$check = check_Email($email,$phone);
if($check){

	$query = "UPDATE contractors SET fname='$fname',lname='$lname',phone='$phone',email='$email',password='$hashpassword',
	speciality='$conSpeciality',location='$location' WHERE id='$user_id' ";

	$result = $conn->execute($query);

	if ($result ){
	  header("location: ../../views/Contractors/contractorProfile.php?msg=Information Succssfully Updated");
	}
	else{
	  header("location: ../../views/Contractors/contractorProfile.php?error=Unsuccess Update");
	}
}else{
	header("location: ../../views/Contractors/contractorProfile.php?error=Email or Phone Number Is Used");
}

?>