<?php
    include "connect.php";
    session_start();

    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $id = intval ($_GET["id"]); // Ensure it's an integer

        // Delete statement
        $sql = "DELETE FROM `minutes` WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        $log_sql = "INSERT INTO history_log (action, file_type, file_id, title) 
        VALUES ('Deleted', 'Minutes', $id, '$title')";
        $conn->query($log_sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                header("Location: files-meetingminutes.php?msg=Minute deleted successfully");
                exit();
            } else {
                echo "Failed: Minute not found.";
            }

            mysqli_stmt_close($stmt);

        } else {
            echo "Failed:" . mysqli_error($conn);
        }
        
    } else  {
        echo "Invalid or missing minute ID.";
    }
?>