<?php
session_start();
require_once("../admin/connection.php");
if(isset($_POST['cID']) && isset($_POST['name']) && isset($_POST['age']) && isset($_POST['email']) && isset($_POST['sex']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['uname']) && isset($_POST['pword']))
    $cID = $_POST['cID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sex = $_POST['sex'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $user = $_POST['uname'];
    $pass = password_hash($_POST['pword'],PASSWORD_DEFAULT);
    $query = "UPDATE customer SET Name='$name', Age = '$age', Sex='$sex', Phone='$phone', Email='$email', Address='$address', username = '$user', password = '$pass' WHERE cusID = '$cID'";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
        header("Location: ../main.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
?>