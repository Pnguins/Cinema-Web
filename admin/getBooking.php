<?php
header("Content-Type:application/json");
require_once('connection.php');
if($conn->connect_errno){
    printf("Connection failed: %s\n", $conn->connect_error);
    exit();
}
if(isset($_GET['cID'])){
    $cID = $_GET['cID'];
    $query = "SELECT * FROM booking where cusID = $cID";
    $result= mysqli_query($conn,$query);
    $rows = array();
    while($r = mysqli_fetch_assoc($result)){
        $rows[] = $r;
    }
    echo json_encode($rows,JSON_PRETTY_PRINT);
}
else{
    $query = "SELECT * from booking";
    $result = mysqli_query($conn,$query);
    $rows =array();
    while($r = mysqli_fetch_assoc($result)){
        $rows[] = $r;
    }
    echo json_encode($rows,JSON_PRETTY_PRINT);
}
?>