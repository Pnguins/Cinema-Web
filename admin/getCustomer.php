<?php
    header("Content-Type:application/json");

    require_once('connection.php');
    if($conn->connect_errno){
        printf("Connection failed: %s\n", $conn->connect_error);
        exit();
    }
    if (isset($_GET['cusID'])){
        $cusID = $_GET['cusID'];
        $query = "SELECT * FROM customer WHERE cusID = $cusID";
        $result = mysqli_query($conn, $query);
        $rows =array();
        while($r = mysqli_fetch_assoc($result)){
            $rows[] = $r;
        }
        echo json_encode($rows,JSON_PRETTY_PRINT);
    }
    else{
    $query = "SELECT * from customer";
    $result = mysqli_query($conn,$query);
    $rows =array();
    while($r = mysqli_fetch_assoc($result)){
        $rows[] = $r;
    }
    echo json_encode($rows,JSON_PRETTY_PRINT);
    }
?>