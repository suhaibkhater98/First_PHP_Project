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

$id=$_POST["hi"];
$sql = "UPDATE service_list SET state = 'canceled',contractor_id=null WHERE ID='$id' ";

$result = $conn->execute($sql);

if ($result) {
    header("location: ../../views/customer/cancelReservation.php?msg=Successful Deleted"); 	
} else {
    header("location: ../../views/customer/cancelReservation.php?error=Unsuccessful Deleted");
}

?>