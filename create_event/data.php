<?php

session_start();
//echo "<pre>", print_r($_FILES['pro']['name']),"</pre>";


require 'db_conn1.php';


$rowSQL = mysqli_query($conn1, "SELECT MAX(event_id) AS max FROM event");
$row = mysqli_fetch_array($rowSQL);
$preid = $row['max'];

$currentId = $preid + 1;

// $event_id = $_SESSION['e_id'];

// echo $event_id;

$event_name = filter_input(INPUT_POST, 'event_name');
$venue = filter_input(INPUT_POST, 'venue');
$date = filter_input(INPUT_POST, 'date');
$time = filter_input(INPUT_POST, 'time');
$type = filter_input(INPUT_POST, 'type');
$category = filter_input(INPUT_POST, 'category');
$participant_amt = filter_input(INPUT_POST, 'participant_amt');
$description = filter_input(INPUT_POST, 'description');
$eo_id = filter_input(INPUT_POST, 'eo_id');
$question = filter_input(INPUT_POST, 'qselection');
$profileImage = $_FILES['pro']['name'];
$free = filter_input(INPUT_POST, 'free_event');

// echo "<pre>", print_r($_FILES),"</pre>";
// echo "<pre>", print_r($_FILES['pro']),"</pre>";


// die();

$target = 'upload/' . $profileImage;
move_uploaded_file($_FILES['pro']['tmp_name'], $target);

if(date("Y-m-d")< $date){
if (!empty($event_name)) {
    // if (!empty($venue)){
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "starfest";
    // Create connection
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);


    if (mysqli_connect_error()) {
        die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
    } else {

        $id = $_SESSION['user_id'];

        $p = "Select eo_id from event_organizer where id='$id'";
        //$result_set= mysqli_query($conn, $p);

        $data1 = mysqli_query($conn, "Select eo_id from event_organizer where id='$id'");
        $row = mysqli_fetch_assoc($data1);
        $eo_idd = $row['eo_id'];

        // echo $eo_idd;

        if ($free == 'yes') {

            $sql = "INSERT INTO event (event_name,category,type,date,time,description, venue,image,eo_id,free)
values ('$event_name','$category','$type','$date','$time','$description','$venue','$profileImage','$eo_idd','$free')";


            $sql1 = "INSERT INTO public_ticket_price (ticket_price,event_id,quantity,category,issue_tickets)
values (0,'$currentId','$participant_amt','free',0)";
        } else {
            $sql = "INSERT INTO event (event_name,category,type,date,time,description, venue,image,eo_id,free)
    values ('$event_name','$category','$type','$date','$time','$description','$venue','$profileImage','$eo_idd','$free')";
        }

        if ($conn->query($sql)) {
            // echo "New record is inserted sucessfully";
            // echo "user id: {$_SESSION['user_id']}<br>";
            header('Location: ../login/eo/index.php');
        } else {
            echo "Error: " . $sql . "
" . $conn->error;
        }

        if ($conn->query($sql1)) {
            // echo "New record is inserted sucessfully";
            // echo "user id: {$_SESSION['user_id']}<br>";
            header('Location: ../login/eo/index.php');
        } else {
            echo "Error: " . $sql1 . "
    " . $conn->error;
        }


        $conn->close();
    }
    // }
    // else{
    // echo "Password should not be empty";
    // die();
    // }
} else {

    header('Location: index.php');
    // echo "Event details required";
    die();
}
}
else{


    // echo "Invalid Event Date";
    ?>

    <script>
      alert("Invalid Event Date");
      header('Location: index.php'); 
      die();
    </script>
    
<?php
// header('Location: index.php');
}
?>
