<?php
session_start();

if(!isset($_SESSION['user_email']) ) {
	if(!strcmp($_SESSION['user_type'], "contractors") ) {
    header("Location:../../index.php");
	}
}

include_once('../../src/common/DBConnection.php');
$conn=new DBConnection();

$id2=$_POST["id"];
$cost=$_POST["service-Cost"];
$des=$_POST["serDesc"];

$sql = "UPDATE service_list SET state = 'finished', cost='$cost', description='$des' WHERE ID='$id2' ";

if ($conn->execute($sql) === TRUE) {
    echo '<script>alert("You have succesffuly updated the Service!  ")</script>'; 
	
} else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}

header("refresh:0.00001; url=../../views/Contractors/liveService.php");
?>