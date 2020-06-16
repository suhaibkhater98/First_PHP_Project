<?php 
session_start();
$cid = $_SESSION['user_id'];
$id = $_GET['id'];
$date = $_GET['date'];
$from = $_GET['from'];
$to = $_GET['to'];

include_once('../../src/common/DBConnection.php');
$conn=new DBConnection();
//date='$date'and available_from='$from' and available_to='$to'
$sql = "DELETE FROM `availability` WHERE contractor_id='$cid' and id='$id'";

$result = $conn->execute($sql);

if ($result ){
      header("location: ../../views/Contractors/RecordAvailability.php?msg=Successfully deleted");
  }
  else{
      header("location: ../../views/Contractors/RecordAvailability.php?error=Unsuccessfully deleted");
  }