<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "db_inpatients";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failure: ". $conn->connect_error);
} 
echo "Connected successfully";


//create the variables from the medical form
$fname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lname = mysqli_real_escape_string($conn,$_POST['lastname']);
$mname = mysqli_real_escape_string($conn,$_POST['middlename']);
$dob = mysqli_real_escape_string($conn,$_POST['dob']);
$sex = mysqli_real_escape_string($conn,$_POST['sex']);
$age = mysqli_real_escape_string($conn,$_POST['age']);
$race = mysqli_real_escape_string($conn,$_POST['race']);

//insert data
$sql = "INSERT INTO `tb_patient` (`first_name`, `last_name`, `middle_name`,`sex`,`age`,`race`,`dob`) VALUES ('$fname', '$lname','$mname','$sex','$age','$race','$dob')";

if (mysqli_query($conn, $sql)){
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>