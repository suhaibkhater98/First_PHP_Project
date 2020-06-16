<?php
include '../../src/common/DBConnection.php';
include '../../src/common/checkEmail.php';
$conn=new DBConnection();

$fname = $_POST['firstName'];
$lname = $_POST['lastName'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone']; 
$query = "INSERT INTO `employees`(`email`, `fname`, `lname`, `phone`, `password`) 
VALUES ('$email','$fname','$lname','$phone','$password')";
if(check_Email_Phone($email,$phone)){
    $result = $conn->execute($query);
    if ($result){
        header("location: ../../views/admin/addEmployee.php?msg=successfully add Employee");
    }
    else{
        header("location: ../../views/admin/addEmployee.php?error=unsuccessfully add Employee");
    }
}
else{
    header("location: ../../views/admin/addEmployee.php?error=phone or Email areadly used.");
}
?>