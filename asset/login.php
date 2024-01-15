<?php
    require_once('../admin/connection.php');
    session_start();
    $error = '';

    $user = '';
    $pass = '';
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];

        if (empty($user)) {
            $error = 'Please enter your username';
        }
        else if (empty($pass)) {
            $error = 'Please enter your password';
        }
        else if (strlen($pass) < 6) {
            $error = 'Password must have at least 6 characters';
        }
        else if ($user === "admin"){
                if($pass == "123456"){
                    $_SESSION['user'] = $user;
                    header("Location: ../admin.php");
                    exit;
                }
                else{
                    $error= "Invalid password for admin";
                }
        }
        else {
            $query = "SELECT * FROM customer WHERE username = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $user);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();

            if (!$data){
                $error = "Invalid username or password";
            }
            else{
                $corr = $data['password'];
                if (!password_verify($pass, $corr)){
                    $error = "Wrong password";
                }
                else{
                    $_SESSION['user'] = $user;
                    $_SESSION['cID'] = $data['cusID'];
                    header('Location: ../main.php');
                    exit();
                }
            } 
        }
        $_SESSION['error'] = $error;
        header("Location: ../main.php");
    }
    $conn->close();
?>
