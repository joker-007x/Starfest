<?php

session_start();
include_once "../config/connection.php";
$not_count = 0;
require_once 'publicevent_db.php';
// Connect to MySQL

// $sql = "SELECT * FROM event ORDER BY date DESC";
$sql="SELECT AVG(r.star_count) as avg,s.id,s.firstname,s.lastname,s.email,s.category,s.email,s.telno,s.sp_id FROM rating r right JOIN service_provider s on r.sp_id=s.id GROUP BY s.id";

$result2 = mysqli_query($conn,$sql) ;
//$row1 = mysqli_fetch_array($result2);

?>



<!DOCTYPE html>
<!--
Template Name: Surogou
Author: <a href="https://www.os-templates.com/">OS Templates</a>
Author URI: https://www.os-templates.com/
Copyright: OS-Templates.com
Licence: Free to use under our free template licence terms
Licence URI: https://www.os-templates.com/template-terms
-->
<html lang="">
<!-- To declare your language - read more here: https://www.w3.org/International/questions/qa-html-language-declarations -->
<head>
<title>Starfest</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">

<link href="layout/styles/work.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" href="../login/css/style.css">
<!-- <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css"> -->
<link href="layout/styles/mainwork.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<?php include('../common/header.php'); ?>
<body id="top">

  

    <div class="sectiontitle">
     <b> <h1 class="logoname"><span><b><u>Service providers</u></b></span></h1>

    </div>




<ul class="nospace group overview">

   
      
<?php 
$i=0;
while($row=mysqli_fetch_assoc($result2)){

if($i%3 == 0){

// echo "<li class=\"one_third first\">";
//echo"<li class=\"one_third \">";

}
?> 
<div class="w3-third w3-margin-bottom">
      <ul class="w3-ul w3-border w3-hover-shadow">
        <li class="w3-theme-l2">
       <h3 > <img src="1.png"> <b> <?php echo $row["firstname"]; ?>         <b><?php echo $row["lastname"]; ?></b></h3>
      
        </li>
        <li class="w3-padding-16"><p>Service - <?php echo $row["category"]; ?></p></li>
        <li class="w3-padding-16"><p>Email - <?php echo $row["email"]; ?></p></li>
        <li class="w3-padding-16"><p>Telephone Number - <?php echo $row["telno"]; ?></p></li>
        <li class="w3-padding-16"><p>Rating - <?php echo $row["avg"]; ?></p></li>
        <?php 
        
        $spId = $row["sp_id"];
        $_SESSION['spid'] = $spId;

        $userid=$row["id"];
        $_SESSION['userid'] = $userid;

       
       
        
        ?>

        <!-- <form action="../spProfile/index.php"> -->

        <a href="../spProfile/index.php?data1=<?php echo $row["sp_id"]?> & data2=<?php echo $row["id"]?>"><button  type="submit" >Contact Service Provider</button> </a>

        <!-- </form> -->

      
      </ul>
    </div>
 <?php


if($i%3 == 3){


}
$i++;
}

?>

</ul>
<a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>