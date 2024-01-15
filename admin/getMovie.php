<?php
header("Content-Type: application/json");
require_once('connection.php');

if ($conn->connect_errno) {
    printf("Connection failed: %s\n", $conn->connect_error);
    exit();
}

else if(isset($_GET['movieID'])){
    $mID = $_GET['movieID'];
    $query = "SELECT * FROM movie WHERE movieID = $mID";
    $result = mysqli_query($conn,$query);
    $rows =array();
    while($r = mysqli_fetch_assoc($result)){
        $rows[] = $r;
    }
    echo json_encode($rows,JSON_PRETTY_PRINT);
} 
else {
    $query = "SELECT * FROM movie";
    $result = mysqli_query($conn, $query);
    $rows = array();
    while ($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
    }
    echo json_encode($rows, JSON_PRETTY_PRINT);
}
?>
