<?php
session_start();
include '../../src/common/DBConnection.php';
$conn=new DBConnection();

$type = $_POST['service_type'];
$desc = $_POST['serviceDesc'];

$query = "INSERT INTO `services`(`type`, `description`) 
VALUES ('$type','$desc')";
$result = $conn->execute($query);

if($_SESSION['user_type']=="admins"){
    if ($result){
        header("location: ../../views/admin/addService.php?msg=successfully add service");
    }
    else{
        header("location: ../../views/admin/addService.php?error=unsuccessfully add service");
    }
}
if($_SESSION['user_type']=="employees"){
    if ($result){
        header("location: ../../views/employee/addService.php?msg=successfully add service");
    }
    else{
        header("location: ../../views/employee/addService.php?error=unsuccessfully add service");
    }
}

?>