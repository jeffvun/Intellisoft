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
//for patients table
$patient_id = 43; //default
$fname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lname = mysqli_real_escape_string($conn,$_POST['lastname']);
$mname = mysqli_real_escape_string($conn,$_POST['middlename']);
$dob = mysqli_real_escape_string($conn,$_POST['dob']);
$sex = mysqli_real_escape_string($conn,$_POST['sex']);
$age = mysqli_real_escape_string($conn,$_POST['age']);
$race = mysqli_real_escape_string($conn,$_POST['race']);
//for hospital table
$hospital_id = 36; //default
$name = mysqli_real_escape_string($conn, $_POST['name']);
$city = mysqli_real_escape_string($conn, $_POST['city']);
$county = mysqli_real_escape_string($conn, $_POST['county']);
$state = mysqli_real_escape_string($conn, $_POST['state']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
//for present address table
$name2 = mysqli_real_escape_string($conn, $_POST['name2']);
$street = mysqli_real_escape_string($conn, $_POST['street']);
$city2 = mysqli_real_escape_string($conn, $_POST['city2']);
$county2 = mysqli_real_escape_string($conn, $_POST['county2']);
$state2 = mysqli_real_escape_string($conn, $_POST['state2']);
// for admisson table
$mrn = mysqli_real_escape_string($conn, $_POST['mrn']);

//insert data
$sql = "INSERT INTO `tb_patient` (`first_name`, `last_name`, `middle_name`,`sex`,`age`,`race`,`dob`) VALUES ('$fname', '$lname','$mname','$sex','$age','$race','$dob')";
$sql2 = "INSERT INTO `tb_hospital` (`name`, `city`, `county`,`state`,`phone`) VALUES ('$name', '$city','$county','$state','$phone')";

//gettings unique keys from the freshly inserted data (foreign keys) 
//for further insertions into the database
$sql_query_patient_id = "SELECT `patient_id` FROM tb_patient WHERE `first_name` LIKE '$fname' and `last_name` LIKE '$lname';";
$sql_query_hospital_id = "SELECT `hospital_id` FROM tb_hospital WHERE `name` LIKE '$name' and `phone` LIKE '$phone';";
$result = mysqli_query($conn, $sql_query_patient_id);
$result2 = mysqli_query($conn, $sql_query_hospital_id);
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $patient_id =  $row['patient_id'];
    echo $patient_id;
}
if(mysqli_num_rows($result2) > 0){
    $row2 = mysqli_fetch_assoc($result2);
    $hospital_id =  $row2['hospital_id'];
    echo $hospital_id;
}

$sql3 = "INSERT INTO `tb_address` (`patient_id`, `name`, `street`, `city`, `county`,`state`) VALUES ('$patient_id', '$name2', '$street','$city2','$county2','$state2')";
$sql4 = "INSERT INTO `tb_admission`(`patient_id`,`hospital_id`) VALUES ('$patient_id', '$hospital_id')";

if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3) && mysqli_query($conn, $sql4) ){
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>