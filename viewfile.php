<?php
include("connect.php"); // Include database connection

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Prevent SQL injection

    // Fetch file path from the database
    $sql = "SELECT attachment FROM resolution WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($file);
    $stmt->fetch();
    $stmt->close();

    if ($file) {
        $filePath = "files/" . $file;

        if (file_exists($filePath)) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');

            @readfile($filePath);
        } else {
            echo "File not found.";
        }
    } else {
        echo "No file associated with this record.";
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>