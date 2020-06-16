<?php

function check_Email($email , $phone){
	$conn=new DBConnection();

	$query = "SELECT email , phone FROM customers WHERE email = '$email' or phone='$phone' UNION ALL
     SELECT email , phone FROM contractors WHERE email = '$email' or phone='$phone'	UNION ALL
     SELECT email , phone FROM employees WHERE email = '$email' or phone='$phone'	UNION ALL
     SELECT email , phone FROM admins WHERE email = '$email' or phone='$phone' ";

	$result = $conn->getAll($query);
	if(count($result) <= 1 ){
		return true;
	}else{
		return false;
	}
}
// for adding employee
function check_Email_Phone($email , $phone){
	$conn=new DBConnection();

	$query = "SELECT email , phone FROM customers WHERE email = '$email' or phone='$phone' UNION ALL
     SELECT email , phone FROM contractors WHERE email = '$email' or phone='$phone'	UNION ALL
     SELECT email , phone FROM employees WHERE email = '$email' or phone='$phone'	UNION ALL
     SELECT email , phone FROM admins WHERE email = '$email' or phone='$phone' ";

	$result = $conn->getAll($query);
	if(count($result) == 0 ){
		return true;
	}else{
		return false;
	}
}
?>