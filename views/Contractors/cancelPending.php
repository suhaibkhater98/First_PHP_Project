<?php
session_start();

if(!isset($_SESSION['user_email']) ) {
    header("Location:../../index.php");
}
if(strcmp($_SESSION['user_type'], "contractors") ) {
    header("Location:../../index.php");
}
include_once('../../src/common/DBConnection.php');
$conn=new DBConnection();

$id2=$_POST["id"];
$sql = "UPDATE service_list SET state = 'live' WHERE ID='$id2' ";

if ($conn->execute($sql) === TRUE) {
    echo '<script>alert("You have succesffuly accepted the Service!  ")</script>'; 
	
} else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}

header("refresh:0.00001; url=Home.php");
?>