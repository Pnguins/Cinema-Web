<?php
session_start();
require_once('connection.php');
if (isset($_POST['cID'])){
    $cID = $_POST['cID'];
    $sql = "SELECT COUNT(bookID) FROM booking WHERE cusID = $cID";
    $result = mysqli_query($conn,$sql);
    if($result){
        $row = mysqli_fetch_assoc($result);
        $count = $row["COUNT(bookID)"];
        if($count > 0){
            $_SESSION['error'] = "Number of booking with cusID ($cID): ". $count;
            header("Location: ../admin.php");
            exit;
        }
        else{
            $stmt = $conn->prepare("DELETE FROM customer WHERE cusID =?");
            $stmt->bind_param("i", $cID);
            $stmt->execute();
        
            $stmt->close();
            $conn->close();
            header("Location: ../admin.php");
            exit; 
        }
    }
}
?>