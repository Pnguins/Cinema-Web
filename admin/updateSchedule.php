<?php
    require_once("connection.php");
    if(isset($_POST['sID']) && isset($_POST['mID']) && isset($_POST['tID']) && isset($_POST['dmovie']) && isset($_POST['tmovie']) && isset($_POST['room'])){
        $sID = $_POST['sID'];
        $mID = $_POST['mID'];
        $tID = $_POST['tID'];
        $tmovie = $_POST['tmovie'];
        $dmovie = $_POST['dmovie'];
        $room = $_POST['room'];

        $query = "UPDATE schedules SET movieID = ?, theatreID = ?, ShowDate = ?, ShowTime=?, Room = ? WHERE scheduleID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iissii",$mID, $tID, $dmovie, $tmovie,$room, $sID);
        if ($stmt->execute()) {
        header("Location: ../admin.php");
        exit();
    }
        else {
        echo "Error:" . $stmt->error;
        header("Location: ../admin.php");
        exit();
    }
}
?>