<?php
session_start();
require_once("../admin/connection.php");
if(isset($_POST['cusID']) && isset($_POST['scheID']) && isset($_POST['total-price']) &&
 isset($_POST['ticket-2d']) && isset($_POST['ticket-3d']) && isset($_POST['ticket-4d'])
  && isset($_POST['popcorn']) && isset($_POST['soda']) && isset($_POST['combo']) ){
    $cID = $_POST['cusID'];
    $sID = $_POST['scheID'];
    $total = $_POST['total-price'];
    $t2 = $_POST['ticket-2d'];
    $t3 = $_POST['ticket-3d'];
    $t4 = $_POST['ticket-4d'];
    $pop = $_POST['popcorn'];
    $soda = $_POST['soda'];
    $combo = $_POST['combo'];

    $query = "INSERT INTO booking (cusID, scheduleID, Ticket2D, Ticket3D, Ticket4D, price, Popcorn, Soda, Combo) VALUES (?, ? , ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiiiidiii",$cID, $sID, $t2, $t3, $t4, $total, $pop, $soda, $combo);
    if($stmt->execute()){
        header("Location: customer-information.php");
        exit;
    }
    else{
        $_SESSION['error']= "There is a problem when adding your booking";
        header("Location: ../main.php");
        exit;
    }
 }
?>