<?php

    if(isset($_POST['save'])) {
        include("connect.php");
        error_reporting(0);

        $id = intval($_POST['id']);
        $no_regSession = mysqli_real_escape_string($conn, $_POST['no_regSession']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $resNo = mysqli_real_escape_string($conn, $_POST['resNo']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        // Handle file uploads
        $genAttachment = $_FILES['genAttachment']['name'];
        $attachment = $_FILES['attachment']['name'];

        $uploadDir = "uploads/";  // Define upload directory

        if (!empty($genAttachment)) {
            $genAttachmentPath = $uploadDir . basename($genAttachment);
            move_uploaded_file($_FILES["genAttachment"]["tmp_name"], $genAttachmentPath);
        } else {
            // Keep the old file if no new file is uploaded
            $genAttachmentQuery = "SELECT genAttachment FROM minutes WHERE id = $id";
            $result = mysqli_query($conn, $genAttachmentQuery);
            $row = mysqli_fetch_assoc($result);
            $genAttachmentPath = $row['genAttachment'];
        }

        if (!empty($attachment)) {
            $attachmentPath = $uploadDir . basename($attachment);
            move_uploaded_file($_FILES["attachment"]["tmp_name"], $attachmentPath);
        } else {
            // Keep the old file if no new file is uploaded
            $attachmentQuery = "SELECT attachment FROM minutes WHERE id = $id";
            $result = mysqli_query($conn, $attachmentQuery);
            $row = mysqli_fetch_assoc($result);
            $attachmentPath = $row['attachment'];
        }

        // Update query
        $sql = "UPDATE `minutes` SET 
                `no_regSession` = '$no_regSession',
                `date` = '$date',
                `genAttachment` = '$genAttachmentPath',
                `resNo` = '$resNo',
                `title` = '$title',
                `status` = '$status',
                `attachment` = '$attachmentPath' WHERE `id` = $id";

        $query = mysqli_query($conn, $sql);


        $log_sql = "INSERT INTO history_log (action, file_type, file_id, title) 
        VALUES ('Edited', 'Minutes', $id, '$title')";
        $conn->query($log_sql);

        if ($query) {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Meeting Minutes Updated',
                            text: 'The minutes have been successfully updated.',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'files-meetingminutes.php';
                            }
                        });
                    });
                  </script>";
        } else {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'There was an error updating the minutes.',
                            confirmButtonText: 'OK'
                        });
                    });
                  </script>";
            header("Location: files-meetingminutes.php");
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<?php 
    include "header.php"; 
    include "connect.php";

?>

<body>

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php 
            include "sidebar.php"; 
        ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body" style="background-color: #f1f9f1">
            <div class="container-fluid" >
                <!-- row -->
    
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

</body>

</html>