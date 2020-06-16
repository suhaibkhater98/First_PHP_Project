<?php
session_start();
$id = $_GET['id'];
echo $id;

include_once('../../src/common/DBConnection.php');
$conn=new DBConnection();
$sql = "UPDATE contractors SET state = 'verified' WHERE id='$id' ";
$result = $conn->execute($sql);

if ($result) {
      echo '<script>alert("Contractor Verified!")</script>'; 	
  } else {
      echo "Error: " . $sql1 . "<br>" . $conn->error;
  }
  
  if($_SESSION['user_type'] == "admins"){
      if ($result ){
          header("location: ../../views/admin/verifyContractor.php");
      }
      else{
          header("location: ../../views/admin/verifyContractor.php");
      }
  }
   if ($_SESSION['user_type'] == "employees"){
      if ($result){
          header("location: ../../views/employee/verifyContractor.php");
      }
      else{
          header("location: ../../views/employee/verifyContractor.php");
      }
  }

?>