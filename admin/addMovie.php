<?php
    require_once("connection.php");
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['actors'])&&isset($_POST['Mname']) && isset($_POST['director']) && isset($_POST['genre1']) && isset($_POST['genre2']) && isset($_POST['trailer'])) {

        // Get form data
        $Mname = $_POST['Mname'];
        $director = $_POST['director'];
        $genre1 = $_POST['genre1'];
        $genre2 = $_POST['genre2'];
        $description = $_POST['description'];
        $trailer = $_POST['trailer'];
        $image = $_FILES['image']['name'];
        $actors = $_POST['actors'];
        // Upload image file
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $extensions_arr = array("jpg","jpeg","png","gif");
        if (in_array($imageFileType,$extensions_arr)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                // Image uploaded successfully
            } else {
                // Failed to upload image
                // $_SESSION['error'] = "Error: Failed to upload image";
                header("Location: ../admin.php");
                exit();
            }
        } else {
            // Invalid file type
            // $_SESSION['error'] = "Error: Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed";
            header("Location: ../admin.php");
            exit();
        }
    
        // Prepare SQL query
        $sql = "INSERT INTO movie (Name, Directors,Actors ,Genre1, Genre2, Description,image, trailer) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $Mname, $director, $actors,$genre1, $genre2, $description, $image, $trailer);
    
        // Execute SQL query
        if ($stmt->execute()) {
            // $_SESSION['success'] = "Movie added successfully";
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