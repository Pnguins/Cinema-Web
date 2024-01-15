<?php
    require_once('../admin/connection.php');
    session_start();
    
    $error = '';
    $name = '';
    $age = '';
    $email = '';
    $uname = '';
    $pword = '';
    $sex = '';
    $phone = '';
    $address = '';
    
    if (isset($_POST['name']) && isset($_POST['age']) && isset($_POST['email']) 
        && isset($_POST['uname']) && isset($_POST['pword']) && isset($_POST['sex']) 
        && isset($_POST['phone']) && isset($_POST['address'])) {
        
        $name = $_POST['name'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $uname = $_POST['uname'];
        $pword = password_hash($_POST['pword'], PASSWORD_DEFAULT); // Hash the password
        $sex = $_POST['sex'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        
        $query = "INSERT INTO customer (Name, Age, Sex, Phone, Email, Address, username, password) VALUES (?, ?, ?, ?, ?, ?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sissssss', $name, $age, $sex, $phone,$email, $address,$uname, $pword);
        
        if (!$stmt->execute()) {
            $_SESSION['error'] = "Error registering account";
        }
        else {
            header('Location: ../main.php');
            exit();
        }
        $stmt->close();
    }
    $_SESSION['error'] = "There is some missing field";
    header("Location: ../main.php");
    $conn->close();
?>
