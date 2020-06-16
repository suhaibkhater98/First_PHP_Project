<?php
session_start();
$id = $_GET['id'];
$type = $_GET['type'];
echo $id;
echo $type;

include_once('../../src/common/DBConnection.php');
$conn=new DBConnection();
if ($type == "contractor"){
      $sql = "UPDATE contractors SET state = 'blocked' WHERE id='$id' ";
      $result = $conn->execute($sql);
}else if ($type == "customer"){
      $sql = "UPDATE customers SET state = 'blocked' WHERE id='$id' ";
      $result = $conn->execute($sql);
}

if ($result) {
      echo '<script>alert("$type Blocked!")</script>'; 	
  } else {
      echo "Error: " . $sql1 . "<br>" . $conn->error;
  }
  
  if($_SESSION['user_type'] == "admins"){
      if ($result ){
          header("location: ../../views/admin/blockUser.php");
      }
      else{
          header("location: ../../views/admin/blockUser.php");
      }
  }
   if ($_SESSION['user_type'] == "employees"){
      if ($result){
          header("location: ../../views/employee/blockUser.php");
      }
      else{
          header("location: ../../views/employee/blockUser.php");
      }
  }

?>