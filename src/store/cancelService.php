<?php
session_start();
$id = $_GET['id'];


include_once('../../src/common/DBConnection.php');
$conn=new DBConnection();
$sql = "UPDATE service_list SET state = 'canceled' WHERE id='$id' ";
$result = $conn->execute($sql);

if ($result) {
      echo '<script>alert("Service Canceled!")</script>'; 	
  } else {
      echo "Error: " . $sql1 . "<br>" . $conn->error;
  }
  
  if($_SESSION['user_type'] == "admins"){
      if ($result ){
          header("location: ../../views/admin/cancelResrvation.php");
      }
      else{
          header("location: ../../views/admin/cancelResrvation.php");
      }
  }
   if ($_SESSION['user_type'] == "employees"){
      if ($result){
          header("location: ../../views/employee/cancelReservation.php");
      }
      else{
          header("location: ../../views/employee/cancelReservation.php");
      }
  }

?>