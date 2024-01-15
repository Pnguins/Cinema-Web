<?php
session_start();
require_once('connection.php');
if (isset($_POST['bID'])){
    $bID = $_POST['bID'];
    $stmt = $conn->prepare("DELETE FROM booking WHERE bookID =?");
    $stmt->bind_param("i", $bID);
    $stmt->execute();

    $stmt->close();
    $conn->close();
    header("Location: ../admin.php");
    exit;
}
?>