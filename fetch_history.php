<?php
include "connect.php";

header("Content-Type: application/json"); // Ensure JSON response
error_reporting(E_ALL);
ini_set("display_errors", 1);

$response = [];

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $resolution_id = intval($_GET["id"]);

    $sql = "SELECT id, file_id, file_type, timestamp, title, action 
            FROM history_log 
            WHERE file_id = ? 
            ORDER BY timestamp DESC";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $resolution_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            // Convert timestamp to a readable format
            $formattedDate = date("F j, Y \\a\\t g:i A", strtotime($row["timestamp"]));
            
            $response[] = [
                "id" => $row["id"],
                "file_id" => $row["file_id"],
                "file_type" => $row["file_type"],
                "title" => $row["title"],
                "action" => $row["action"],
                "timestamp" => $formattedDate
            ];
        }        

        echo json_encode($response);
    } else {
        echo json_encode(["error" => "SQL Error: " . $conn->error]);
    }
} else {
    echo json_encode(["error" => "Invalid ID"]);
}

?>
