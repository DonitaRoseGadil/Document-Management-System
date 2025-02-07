<?php
include "connect.php";
session_start();

if (isset($_GET["reso_no"]) && is_numeric($_GET["reso_no"])) {
    $reso_no = intval($_GET["reso_no"]); // Ensure it's an integer

    // Use prepared statements for security
    $sql = "DELETE FROM `resolution` WHERE reso_no = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $reso_no);
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
