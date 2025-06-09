<?php
include 'connect.php'; // your DB connection

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // sanitize

    $stmt = $conn->prepare("SELECT * FROM officials WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $official = $result->fetch_assoc();

    if ($official) {
        echo json_encode($official); // ✅ valid official found
    } else {
        echo json_encode((object)[]); // ✅ empty object instead of null
    }
} else {
    echo json_encode((object)[]); // ✅ no ID passed, return empty
}
