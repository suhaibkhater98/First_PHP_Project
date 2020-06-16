<?php
session_start();
include_once('../../src/common/DBConnection.php');
$conn=new DBConnection();

$contractor_id = $_POST['contractor_ID'];
$service_id = $_POST['service_ID'];
$date = $_POST['date'];
$time = $_POST['time'];

$sql = "UPDATE service_list SET contractor_ID='$contractor_id',state='assigned' WHERE ID='$service_id' ";
$query = "SELECT contractor_id FROM availability WHERE ('$time' between available_from and available_to) AND '$date' = date ";

$result = $conn->getAll($query);

if( checkValue($result,$contractor_id)){
    if ($conn->execute($sql)) {
        if ($_SESSION['user_type'] == "employees"){
            header("location: ../../views/employee/assignService.php?msg=Successfully Assigned");
        }
        else if ($_SESSION['user_type'] == "admins"){
            header("location: ../../views/admin/assignService.php?msg=Successfully Assigned");
        }
    } else {
        if ($_SESSION['user_type'] == "employees"){
            header("location: ../../views/employee/assignService.php?error=Unsuccessfully Assigned");
        }
        else if ($_SESSION['user_type'] == "admins"){
            header("location: ../../views/admin/assignService.php?error=Unuccessfully Assigned");
        }
    }
}else{
    if ($_SESSION['user_type'] == "employees"){
        header("location: ../../views/employee/assignService.php?error=Invalid Contractor ID $date");
    }
    else if ($_SESSION['user_type'] == "admins"){
        header("location: ../../views/admin/assignService.php?error=Invalid Contractor ID $date");
    }
}

function checkValue($array , $value)
{
    foreach ($array as $item)
	{
        foreach($item as $row)
		{
            if($row == $value)
                return true;
		}
	}
    return false;
}