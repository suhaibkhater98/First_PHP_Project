<?php
include("../common/DBConnection.php");
if(isset($_POST['signUp'])){
     $conn=new DBConnection();

     $email = $_POST['email'];
     $password = $_POST['password'];
     $fname = $_POST['fname'];
     $lname = $_POST['lname'];
     $phone = $_POST['phone'];
     $type = $_POST['choose'];
	 $conType = $_POST['typeChoose'];
     $salt = "qservice";
     $hashpassword = sha1($password.$salt);
     $query = "SELECT email , phone FROM customers WHERE email = '$email' or phone='$phone' UNION ALL
     SELECT email , phone FROM contractors WHERE email = '$email' or phone='$phone'	UNION ALL
     SELECT email , phone FROM employees WHERE email = '$email' or phone='$phone'	UNION ALL
     SELECT email , phone FROM admins WHERE email = '$email' or phone='$phone'	Limit 1";

     $check = $conn->getOne($query);
     if($check == 0){
          if ($type == "customer"){
          $INSERT = "INSERT Into customers (email, password, fname, lname , phone) 
          values('$email', '$hashpassword', '$fname','$lname','$phone')";
          $result = $conn->execute($INSERT);
          if($result){   
               header("location: ../../index.php?msg=successfully SignUp");}
          else{
               header("location: ../../index.php?error=Unsuccessfully SignUp"); }
          }
          else if ($type == "contractor"){
          $INSERT = "INSERT Into contractors (email, password, fname, lname , phone, speciality) 
          values('$email', '$hashpassword', '$fname','$lname','$phone','$conType')";
          $result = $conn->execute($INSERT);
          if($result){   
               header("location: ../../index.php?msg=Successfully Signup");}
          else{
               header("location: ../../index.php?error=Unsuccessfully SignUp"); }
          }
     }
     else{
          header("location: ../../index.php?error=the Email or Phone is already registered");
     }
}
    ?>