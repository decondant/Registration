<?php

$username = $_POST['username'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phoneCode = $_POST['phoneCode'];
$phone = $_POST['phone'];

if (!empty($username) || !empty($password) ||!empty($gender) ||!empty($email) ||!empty($phoneCode) ||!empty($phone)  ) {
	# code...
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "test";

//creating conn
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if (mysqli_connect_error()) {
	# code...
	die('Connect Error('. mysqli_connect_error().')'. mysqli_connect());
} else{
	$SELECT = "SELECT email from register where email = ? Limit 1";
	$INSERT = "INSERT Into register (username, password, gender, email, phoneCode, phone) values(?, ?, ?, ?, ?, ?) ";

//prepare statement
	$stmt = $conn->prepare($SELECT);
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$stmt->bind_result($email);
	$stmt->store_result();
	$rnum = $stmt->num_rows;

	if($rnum==0)
	{
		$stmt->close();
		$stmt = $conn->prepare($INSERT);
		$stmt->bind_param("ssssii", $username,$password,$gender,$email,$phoneCode,$phone);
		$stmt->execute();
		echo "record added.";
	}else{
		echo "email already registered.";
	}
	$stmt->close();
	$conn->close();

}


} else{
	echo "All fields are required.";
	die();
}



?>