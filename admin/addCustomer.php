<?php
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['age']) && isset($_POST['email'])  && isset($_POST['sex']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['username']) && isset($_POST['password'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $sex = $_POST['sex'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $age = $_POST['age'];
        $user = $_POST['username'];
        $pass = password_hash($_POST['password'],PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("INSERT INTO customer (Name, Age, Sex, Phone, Email, Address, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sisissss", $name, $age, $sex, $phone, $email, $address, $user, $pass);
        if ($stmt->execute()) {
            header("Location: ../admin.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    }
    else{
        echo "Not set";
    }
?>
