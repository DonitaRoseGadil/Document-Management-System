<?php
include 'connect.php';

// Tell browser this is a JSON response
header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute delete statement
    $stmt = $conn->prepare("DELETE FROM officials WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Official deleted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting official.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'ID not provided.']);
}
?>

