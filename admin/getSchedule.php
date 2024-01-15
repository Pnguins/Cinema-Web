<?php
    header("Content-Type:application/json");

    require_once('connection.php');
    if($conn->connect_errno){
        printf("Connection failed: %s\n", $conn->connect_error);
        exit();
    }
    if (isset($_GET['scheduleID'])){
        $sID = $_GET['scheduleID'];
        $query = "SELECT * from schedules WHERE scheduleID = $sID";
        $result = mysqli_query($conn, $query);
        $rows =array();
        while($r = mysqli_fetch_assoc($result)){
            $rows[] = $r;
        }
        echo json_encode($rows, JSON_PRETTY_PRINT);
    }
    else if(isset($_GET['movieID'])){
        $mID = $_GET['movieID'];
        $query = "SELECT * FROM schedules WHERE movieID = $mID";
        $result = mysqli_query($conn,$query);
        $rows =array();
        while($r = mysqli_fetch_assoc($result)){
            $rows[] = $r;
        }
        echo json_encode($rows,JSON_PRETTY_PRINT);
    }
    else if(isset($_GET['ShowDate']) and isset($_GET['movieID'])){
        $date = $_GET['ShowDate'];
        $mID = $_GET['movieID'];
        $query = "SELECT * FROM schedules WHERE ShowDate = '$date' and movieID = '$mID'";
        $result = mysqli_query($conn,$query);
        $rows =array();
        while($r = mysqli_fetch_assoc($result)){
            $rows[] = $r;
        }
        echo json_encode($rows,JSON_PRETTY_PRINT);
    }
    else if(isset($_GET['ShowDate']) && isset($_GET['theatreID']) && isset($_GET['movieID'])){
        $date = $_GET['ShowDate'];
        $tID = $_GET['theatreID'];
        $mID = $_GET['movieID'];
        $query = "SELECT * FROM schedules WHERE ShowDate = '$date' and theatreID = '$tID' and movieID = '$mID'";
        $result = mysqli_query($conn,$query);
        $rows =array();
        while($r = mysqli_fetch_assoc($result)){
            $rows[] = $r;
        }
        echo json_encode($rows,JSON_PRETTY_PRINT);
    }
    else if(isset($_GET['ShowDate']) && isset($_GET['theatreID']) && isset($_GET['ShowTime']) && isset($_GET['movieID'])){
        $date = $_GET['ShowDate'];
        $tID = $_GET['theatreID'];
        $time =  $_GET['ShowTime'];
        $mID = $_GET["MovieID"];
        $query = "SELECT * FROM schedules WHERE ShowDate = '$date' and theatreID = '$tID' and ShowTime = '$time' and movieID='$mID'";
        $result = mysqli_query($conn,$query);
        $rows =array();
        while($r = mysqli_fetch_assoc($result)){
            $rows[] = $r;
        }
        echo json_encode($rows,JSON_PRETTY_PRINT);
    }
    else{
        $query = "SELECT * from schedules";
        $result = mysqli_query($conn,$query);
        $rows =array();
        while($r = mysqli_fetch_assoc($result)){
            $rows[] = $r;
        }
        echo json_encode($rows,JSON_PRETTY_PRINT);
    }
?>