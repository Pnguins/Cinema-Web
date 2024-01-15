<?php
session_start();
require_once('connection.php');
if (isset($_POST['sID'])){
    $sID = $_POST['sID'];
    $sql = "SELECT COUNT(bookID) FROM booking WHERE scheduleID = $sID";
    $result = mysqli_query($conn,$sql);
    if($result){
        $row = mysqli_fetch_assoc($result);
        $count = $row["COUNT(bookID)"];
        if($count > 0){
            $_SESSION['error'] = "Number of booking with scheduleID ($sID): ". $count;
            header("Location: ../admin.php");
            exit;
        }
        else{
            $stmt = $conn->prepare("DELETE FROM schedules WHERE scheduleID =?");
            $stmt->bind_param("i", $sID);
            $stmt->execute();
        
            $stmt->close();
            $conn->close();
            header("Location: ../admin.php");
            exit; 
        }
    }
}
?>