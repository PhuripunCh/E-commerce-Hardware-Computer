<?php
// Assume you have a database connection established

// Query to count new data in oderlist table
$sql = "SELECT COUNT(*) AS count FROM oderlist WHERE created_at > DATE_SUB(NOW(), INTERVAL 1 HOUR)"; // Change the interval as per your requirement

// Execute the query
$result = mysqli_query($connection, $sql);

if ($result) {
    // Fetch the count
    $row = mysqli_fetch_assoc($result);
    $newDataCount = $row['count'];

    // Return the count as JSON
    echo json_encode(['count' => $newDataCount]);
} else {
    echo json_encode(['count' => 0]); // Return 0 if there's an error
}

// Close the connection
mysqli_close($connection);
?>