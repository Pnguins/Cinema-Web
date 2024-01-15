<?php
session_start();
require_once('connection.php');
if (isset($_POST['mID'])){
    $mID = $_POST['mID'];
    $sql = "SELECT COUNT(scheduleID) FROM schedules WHERE movieID = $mID";
    $result = mysqli_query($conn,$sql);
    if($result){
        $row = mysqli_fetch_assoc($result);
        $count = $row["COUNT(scheduleID)"];
        if($count > 0){
            $_SESSION['error'] = "Number of schedules with movieID ($mID): ". $count;
            header("Location: ../admin.php");
            exit;
        }
        else{
            $stmt = $conn->prepare("DELETE FROM movie WHERE movieID =?");
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