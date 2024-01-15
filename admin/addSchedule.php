<?php
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mID']) && isset($_POST['tID']) && isset($_POST['dmovie']) &&isset($_POST['tmovie']) && isset($_POST['room'])){
        $mID = $_POST['mID'];
        $tID = $_POST['tID'];
        $tmovie = $_POST['tmovie'];
        $dmovie = $_POST['dmovie'];
        $room = $_POST['room'];
        
        $stmt = $conn->prepare("INSERT INTO schedules (movieID, theatreID, ShowDate, ShowTime, Room) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iissi", $mID, $tID, $dmovie,$tmovie, $room);
        if ($stmt->execute()) {
            header("Location: ../admin.php");
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    }
?>