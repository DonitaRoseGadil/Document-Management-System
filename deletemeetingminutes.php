<?php
    include "connect.php";
    session_start();

    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $id = intval ($_GET["id"]); // Ensure it's an integer

        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: 'You won't be able to revert this!',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Your file has been deleted.',
                        icon: 'success'
                        });
                window.location.href = 'files-resolution.php';
                }
            });
        });
        </script>";

        // Delete statement
        $sql = "DELETE FROM `minutes` WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);

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