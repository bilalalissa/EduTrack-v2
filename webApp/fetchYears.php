<?php
require_once("db.php");

header('Content-Type: application/json');

try {
    // Prepare the SQL query to select years
    $query = "SELECT y_id, year FROM years ORDER BY year ASC";
    $stmt = $db->prepare($query);
    
    // Execute the query
    $stmt->execute();

    // Fetch all years data
    $years = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // console.log($years);  // To see what data is received from the server
    // Echoing JSON encoded years data
    echo json_encode($years);
} catch (PDOException $e) {
    // Handle any errors here
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
