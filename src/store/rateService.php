<?php 
session_start();

if(!isset($_SESSION['user_email']) ) {
    header("Location:../../index.php");
}
if(!strcmp($_SESSION['user_type'], "customer") ) {
    header("Location:../../index.php");
}
$cid=$_SESSION['user_id'];
include_once('../../src/common/DBConnection.php');

$conn=new DBConnection();

$id=$_POST["ID"];
$rate=$_POST["select_catalog"];
$sql = "UPDATE service_list SET Rating = '$rate' WHERE ID='$id' ";

$result = $conn->execute($sql);

if ($result) {
    echo '<script>alert("You have succesffuly rate the Service!  ")</script>'; 	
} else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}

header("location: ../../views/customer/rateService.php"); 

?>