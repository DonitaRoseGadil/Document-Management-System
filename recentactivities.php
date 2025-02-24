<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "lgu_dms");

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Fetch recent activities
$query = "
    (SELECT 'Resolution' AS type, title, updated_at AS date FROM resolution ORDER BY updated_at DESC LIMIT 4)
    UNION
    (SELECT 'Ordinance' AS type, title, updated_at AS date FROM ordinance ORDER BY updated_at DESC LIMIT 4)
    UNION
    (SELECT 'Minutes' AS type, title, updated_at AS date FROM minutes ORDER BY updated_at DESC LIMIT 4)
    ORDER BY date DESC LIMIT 4
";

$result = $conn->query($query);

if (!$result) {
    die(json_encode(["error" => "SQL Error: " . $conn->error]));
}

$activities = [];

while ($row = $result->fetch_assoc()) {
    $activities[] = [
        "title" => $row["type"] . " - " . $row["title"],
        "date" => date("F d, Y h:i A", strtotime($row["date"]))
    ];
}

$response = [
    "activities" => $activities,
    "last_update" => count($activities) > 0 ? date("F d, Y h:i A") : "No updates yet"
];

echo json_encode($response);
?>


