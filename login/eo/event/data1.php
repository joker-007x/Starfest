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

$sql1 = "DELETE FROM event_request WHERE event_id='$eid'";





if ($conn->query($sql)){
// echo "New record is inserted sucessfully";
// echo "user id: {$_SESSION['user_id']}<br>";
header('Location: ../event_dashbord.php');
}
else{
echo "Error: ". $sql ."
". $conn->error;
}

if ($conn->query($sql1)){
    // echo "New record is inserted sucessfully";
    // echo "user id: {$_SESSION['user_id']}<br>";
    header('Location: ../event_dashboard.php');
    }
    else{
    echo "Error: ". $sql1 ."
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