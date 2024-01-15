<?php
require_once('connection.php');
if (isset($_POST['tID']) && isset($_POST['Tname']) && isset($_POST['location']) && isset($_POST['nroom'])){
    $tID = $_POST['tID'];
    $tName = $_POST['Tname'];
    $location = $_POST['location'];
    $nroom = $_POST['nroom'];

    $query = "UPDATE theatre SET Name = ?, Location = ?, numRoom =? where theatreID = ? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssis",$tName,$location,$nroom,$tID);
    if ($stmt->execute()) {
        // $_SESSION['success'] = "Movie added successfully";
        header("Location: ../admin.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
        header("Location: ../admin.php");
        exit();
    }
}   
?>