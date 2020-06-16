<?php
session_start();
include '../../src/common/DBConnection.php';
$conn=new DBConnection();

$id = $_GET['id'];

$query = "SET FOREIGN_KEY_CHECKS=0;
		  DELETE FROM services WHERE services.id = '$id';
          SET FOREIGN_KEY_CHECKS=1;";
$result = $conn->execute($query);
if($result){
      if($_SESSION['user_type']=="admins"){
            header("location: ../../views/admin/viewService.php?msg=Successfully deleted service");
      }
      else if($_SESSION['user_type']=="employees"){
            header("location: ../../views/employee/viewService.php?msg=Successfully deleted service");     
      }
}else{
      if($_SESSION['user_type']=="admins"){
            header("location: ../../views/admin/viewService.php?error=Unsuccessfully service delete");
      }
      else if ($_SESSION['user_type']=="employees"){
            header("location: ../../views/employee/viewService.php?error=Unsuccessfully service delete");
      }
}
?>