<?php
    require_once("connection.php");
    if (isset($_POST['bID']) && isset($_POST['cID']) && isset($_POST['sID']) && isset($_POST['t2']) && isset($_POST['t3']) && isset($_POST['t4']) && isset($_POST['total']) && isset($_POST['popcorn']) && isset($_POST['soda']) && isset($_POST['combo'])) {

        // Get form data
        $bookID = $_POST['bID'];
        $cID = $_POST['cID'];
        $sID = $_POST['sID'];
        $t2 = $_POST['t2'];
        $t3 = $_POST['t3'];
        $t4 = $_POST['t4'];
        $total = $_POST['total'];
        $popcorn = $_POST['popcorn'];
        $soda = $_POST['soda'];
        $combo = $_POST['combo'];
    
        // Prepare SQL query
        $sql = "UPDATE booking SET cusID = ?, scheduleID = ?, Ticket2D = ?, Ticket3D = ?, Ticket4D = ?, price = ?, Popcorn = ?, Soda = ?, Combo = ? WHERE bookID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiiiiiiiii", $cID, $sID, $t2, $t3, $t4, $total, $popcorn, $soda, $combo, $bookID);
    
        // Execute SQL query
        if ($stmt->execute()) {
            // $_SESSION['success'] = "Booking updated successfully";
            header("Location: ../admin.php");
            exit();
        } else {
            // $_SESSION['error'] = "Error: " . $stmt->error;
            header("Location: ../admin.php");
            exit();
        }
    } else {
        // Form was not submitted
        header("Location: ../admin.php");
        exit();
    }
?>
