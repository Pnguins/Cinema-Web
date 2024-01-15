<?php
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Tname"]) && isset($_POST["location"]) && isset($_POST["nroom"])){
        $Tname = $_POST["Tname"];
        $location = $_POST["location"];
        $nroom = $_POST["nroom"];
        
        $stmt = $conn->prepare("INSERT INTO theatre (Name, Location, numRoom) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $Tname, $location, $nroom);
        if ($stmt->execute()) {
            header("Location: ../admin.php");
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    }
?>