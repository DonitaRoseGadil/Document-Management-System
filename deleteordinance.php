<?php
include "connect.php";
session_start();

if (isset($_GET["mo_no"]) && is_numeric($_GET["mo_no"])) {
    $mo_no = intval($_GET["mo_no"]); // Ensure it's an integer

    // Use prepared statements for security
    $sql = "DELETE FROM `ordinance` WHERE mo_no = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $mo_no);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            header("Location: files-ordinances.php?msg=Ordinance deleted successfully");
            exit();
        } else {
            echo "Failed: Ordinance not found.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
} else {
    echo "Invalid or missing ordinance ID.";
}
?>
