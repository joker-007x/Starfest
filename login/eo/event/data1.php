<?php

session_start();


$eid = $_GET['data1'];






// if (!empty($venue)){
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "starfest";
// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);


if (mysqli_connect_error()){
die('Connect Error ('. mysqli_connect_errno() .') '
. mysqli_connect_error());
}
else{

$id= $_SESSION['user_id'];


$sql = "DELETE FROM event WHERE event_id='$eid'";






if ($conn->query($sql)){
// echo "New record is inserted sucessfully";
// echo "user id: {$_SESSION['user_id']}<br>";
header('Location: ../index.php');
}
else{
echo "Error: ". $sql ."
". $conn->error;
}
$conn->close();
}
// }
// else{
// echo "Password should not be empty";
// die();
// }


?>