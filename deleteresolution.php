<?php
include "connect.php";
session_start();

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = intval($_GET["id"]); // Ensure it's an integer

    // Use prepared statements for security
    $sql = "DELETE FROM `resolution` WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    $log_sql = "INSERT INTO history_log (action, file_type, file_id, title) 
            VALUES ('Deleted', 'Resolution', $id, '$title')";
    $conn->query($log_sql);


    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            header("Location: files-resolution.php?msg=Resolution deleted successfully");
            exit();
        } else {
            echo "Failed: Resolution not found.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
} else {
    echo "Invalid or missing resolution ID.";
}
?>


