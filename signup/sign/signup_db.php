<?php

$firstname = filter_input(INPUT_POST, 'firstname');
$lastname = filter_input(INPUT_POST, 'lastname');
$address = filter_input(INPUT_POST, 'address');
$email = filter_input(INPUT_POST, 'email');
$telno = filter_input(INPUT_POST, 'telno');
$password = filter_input(INPUT_POST, 'password');
$role = filter_input(INPUT_POST, 'role');

if($emailcount==0){
if (!empty($firstname)){
if (!empty($password)){
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "starfest";
// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

$data = mysqli_query($conn,"SELECT COUNT(`email`) AS num FROM `user` where email='$email'");
$row = mysqli_fetch_assoc($data);
$emailcount = $row['num'];


if (mysqli_connect_error()){
die('Connect Error ('. mysqli_connect_errno() .') '
. mysqli_connect_error());
}
else{
    $sql = "INSERT INTO form(firstname, lastname, address, email, telno, password,role)
VALUES ('$firstname','$lastname','$address','$email','$telno','$password','$role')";
    if($role=='eventorganizer'){

        if (mysqli_connect_error()){
            die('Connect Error ('. mysqli_connect_errno() .') '
            . mysqli_connect_error());
            }
            else{
            
             
                $sql="INSERT INTO user (type,email,password) values ('eo','$email','$password')";
            
            
            if ($conn->query($sql)){
                //echo "New record is inserted sucessfully";
            
                // header('location:../eo_dashboard/index.php'); 
                }
                else{
                echo "Error: ". $sql ."
                ". $conn->error;
                }
                // $conn->close();
                }

                if (mysqli_connect_error()){
                    die('Connect Error ('. mysqli_connect_errno() .') '
                    . mysqli_connect_error());
                    }
                    else{
                    
                    
                    $id= "SELECT id FROM user WHERE email='$email' and password='$password'";
                    $result = mysqli_query($conn, $id);
                    $row = mysqli_fetch_assoc($result);
                    //echo $row['eo_id'];
                   
                    $sql1 = "INSERT INTO event_organizer (id,firstname, lastname, address, email, telno, password)
            values ('$row[id]','$firstname','$lastname','$address','$email','$telno','$password')";
            
            echo "<script>alert('Login Credentials verified')</script>";
            
                    
                    if ($conn->query($sql1)){
                       // echo "New record is inserted sucessfully";
                    
                        header('location:../../login/index.php'); 
                        }
                        else{
                        echo "Error: ". $sql1 ."
                        ". $conn->error;
                        }
                        // $conn->close();
                        }

        
// $sql = "INSERT INTO event_organizer(12,firstname, lastname, address, email, telno, password)
// VALUES ('$firstname','$lastname','$address','$email','$telno','$password')";}

    }

elseif($role=='eventparticipant'){


    if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') '
        . mysqli_connect_error());
        }
        else{
        
         
            $sql="INSERT INTO user (type,email,password) values ('ep','$email','$password')";
        
        
        if ($conn->query($sql)){
            //echo "New record is inserted sucessfully";
        
            // header('location:../eo_dashboard/index.php'); 
            }
            else{
            echo "Error: ". $sql ."
            ". $conn->error;
            }
            // $conn->close();
            }

            if (mysqli_connect_error()){
                die('Connect Error ('. mysqli_connect_errno() .') '
                . mysqli_connect_error());
                }
                else{
                
                
                $id= "SELECT id FROM user WHERE email='$email' and password='$password'";
                $result = mysqli_query($conn, $id);
                $row = mysqli_fetch_assoc($result);
                //echo $row['eo_id'];
               
                $sql1 = "INSERT INTO event_participant (id,firstname, lastname, address, email, telno, password)
        values ('$row[id]','$firstname','$lastname','$address','$email','$telno','$password')";
        
        echo "<script>alert('Login Credentials verified')</script>";
        
                
                if ($conn->query($sql1)){
                   // echo "New record is inserted sucessfully";
                
                    header('location:../../login/index.php'); 
                    }
                    else{
                    echo "Error: ". $sql1 ."
                    ". $conn->error;
                    }
                    // $conn->close();
                    }

    // $sql = "INSERT INTO event_participant(firstname, lastname, address, email, telno, password)
    // VALUES ('$firstname','$lastname','$address','$email','$telno','$password')";}

}

    elseif($role=='serviceprovider'){

        if (mysqli_connect_error()){
            die('Connect Error ('. mysqli_connect_errno() .') '
            . mysqli_connect_error());
            }
            else{
            
             
                $sql="INSERT INTO user (type,email,password) values ('sp','$email','$password')";
            
            
            if ($conn->query($sql)){
                //echo "New record is inserted sucessfully";
            
                // header('location:../eo_dashboard/index.php'); 
                }
                else{
                echo "Error: ". $sql ."
                ". $conn->error;
                }
                // $conn->close();
                }


                if (mysqli_connect_error()){
                    die('Connect Error ('. mysqli_connect_errno() .') '
                    . mysqli_connect_error());
                    }
                    else{
                    
                    
                    $id= "SELECT id FROM user WHERE email='$email' and password='$password'";
                    $result = mysqli_query($conn, $id);
                    $row = mysqli_fetch_assoc($result);
                    //echo $row['eo_id'];
                   
                    $sql1 = "INSERT INTO service_provider (id,firstname, lastname, address, email, telno, password)
            values ('$row[id]','$firstname','$lastname','$address','$email','$telno','$password')";
            
            echo "<script>alert('Login Credentials verified')</script>";
            
                    
                    if ($conn->query($sql1)){
                       // echo "New record is inserted sucessfully";
                    
                        header('location:../../login/index.php'); 
                        }
                        else{
                        echo "Error: ". $sql1 ."
                        ". $conn->error;
                        }
                        // $conn->close();
                        }

        // $sql = "INSERT INTO service_provider(firstname, lastname, address, email, telno, password)
        // VALUES ('$firstname','$lastname','$address','$email','$telno','$password')";}

    }
// if ($conn->query($sql)){
// echo "New record is inserted sucessfully";
// }
// else{
// echo "Error: ". $sql ."
// ". $conn->error;
// }
// $conn->close();
}
}
else{
echo "Password should not be empty";
die();
}
}


else{
echo "Username should not be empty";
die();
}
}
else{

    echo "<script type='text/javascript'>alert('email is already exist')</script>";


}


?>