<?php
    require_once("../admin/connection.php");
    // Get the search term from the client
    $term = $_GET['keyword'];

    // Construct the SQL query to search for suggestions
    $sql = "SELECT * FROM movie WHERE Name LIKE '" . $term . "%'";

    // Execute the query and get the results
    $result = $conn->query($sql);

    // Construct an array of suggestions
    $suggestions = array();
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row;
    }

    // Send the suggestions back to the client as a JSON object
    header('Content-Type: application/json');
    echo json_encode($suggestions);
?>
