<?php
session_start();
require_once('connection.php');
if (isset($_POST['tID'])){
    $tID = $_POST['tID'];
    $sql = "SELECT COUNT(scheduleID) FROM schedules WHERE theatreID = $tID";
    $result = mysqli_query($conn,$sql);

    if($result){
        $row = mysqli_fetch_assoc($result);
        $count = $row["COUNT(scheduleID)"];
        if($count > 0){
            $_SESSION['error'] = "Number of schedule with theatreID ($tID): ". $count;
            header("Location: ../admin.php");
            exit;
        }
        else{
            $stmt = $conn->prepare("DELETE FROM theatre WHERE theatreID =?");
            $stmt->bind_param("i", $tID);
            $stmt->execute();
            $stmt->close();
            $conn->close();
            header("Location: ../admin.php");
            exit;
        }
    }
}
?>