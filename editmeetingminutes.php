<?php

    if(isset($_POST['save'])) {
        include("connect.php");
        error_reporting(0);
        session_start();

        $id = intval($_POST['id']);
        $no_regSession = mysqli_real_escape_string($conn, $_POST['no_regSession']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $resNo = mysqli_real_escape_string($conn, $_POST['resNo']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);
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
            $genAttachment = $row['genAttachment'];
        }

        if (!empty($attachment)) {
            $attachmentPath = $uploadDir . basename($attachment);
            move_uploaded_file($_FILES["attachment"]["tmp_name"], $attachmentPath);
        } else {
            // Keep the old file if no new file is uploaded
            $attachmentQuery = "SELECT attachment FROM minutes WHERE id = $id";
            $result = mysqli_query($conn, $attachmentQuery);
            $row = mysqli_fetch_assoc($result);
            $attachment = $row['attachment'];
        }

        // Update query
        $sql = "UPDATE `minutes` SET 
                `no_regSession` = '$no_regSession',
                `date` = '$date',
                `genAttachment` = '$genAttachmentPath',
                `resNo` = '$resNo',
                `title` = '$title',
                `type` = '$type',
                `status` = '$status',
                `attachment` = '$attachmentPath' WHERE `id` = $id";

        $query = mysqli_query($conn, $sql);

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
            include "navheader.php";
            include "sidebar.php"; 
        ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid" >
                <!-- row -->
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-8 col-xxl-12 items-center">                        
                        <div class="card" style="align-self: center;">
                            <div class="card-header d-flex justify-content-center">
                                <h4 class="card-title text-center" style="color: #098209; ">EDIT MEETING MINUTES</h4>
                            </div>
                            <?php
                                include("connect.php");
                                $id = intval($_GET['id']); // Ensure ID is an integer
                                $sql = "SELECT * FROM `minutes` WHERE id = $id LIMIT 1";
                                $result = mysqli_query($conn, $sql);
                                
                                if ($result && mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                } else {
                                    echo "<script>alert('Invalid Record ID!'); window.location.href='files-meetingminutes.php';</script>";
                                    exit;
                                }
                            ?>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <input type="hidden" class="form-control" value="<?php echo $row['id']?>" id="id" name="id">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color: #000000">No. of Regular Session</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Please type here..." value="<?php echo $row['no_regSession']?>" id="no_regSession" name="no_regSession">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color:#000000">Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" placeholder="Please type here..." value="<?php echo $row['date']?>" id="date" name="date">
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="background-color: #098209;"> <i class="fa fa-paperclip"></i></span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="genAttachment" name="genAttachment" onchange="updateFileName('genAttachmentLabel')">
                                                <label class="custom-file-label" id="genAttachmentLabel"> 
                                                    <?php echo !empty($row['genAttachment']) ? $row['genAttachment'] : "Choose file"; ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color: #000000">Resolution No.:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="<?php echo $row['resNo']?>" name="resNo" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color: #000000">Title:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="<?php echo $row['title']?>" name="title" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="type" class="col-sm-3 col-form-label" style="color: #000000">Type:</label>
                                            <div class="col-sm-9">
                                                <select id="type" value="<?php echo $row['type']?>" name="type" class="form-control">
                                                    <option value="" selected>Choose...</option>
                                                    <option value="Draft" <?php if ($row['type'] == "Draft") echo "selected"; ?>>Draft</option>
                                                    <option value="Information" <?php if ($row['type'] == "Information") echo "selected"; ?>>Information</option>
                                                    <option value="Referred to Committee" <?php if ($row['type'] == "Referred to Committee") echo "selected"; ?>>Referred to Committee</option>
                                                    <option value="Approved" <?php if ($row['type'] == "Approved") echo "selected"; ?>>Approved</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="status" class="col-sm-3 col-form-label" style="color: #000000">Status:</label>
                                            <div class="col-sm-9">
                                                <select id="status" name="status" class="form-control">
                                                    <option value="" selected>Choose...</option>
                                                    <option value="Draft" <?php if ($row['status'] == "Draft") echo "selected"; ?>>Draft</option>
                                                    <option value="Information" <?php if ($row['status'] == "Information") echo "selected"; ?>>Information</option>
                                                    <option value="Referred to Committee" <?php if ($row['status'] == "Referred to Committee") echo "selected"; ?>>Referred to Committee</option>
                                                    <option value="Approved" <?php if ($row['status'] == "Approved") echo "selected"; ?>>Approved</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="background-color: #098209;"> <i class="fa fa-paperclip"></i></span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="attachment" name="attachment" onchange="updateFileName('attachmentLabel')">
                                                <label class="custom-file-label" id="attachmentLabel"> 
                                                    <?php echo !empty($row['attachment']) ? $row['attachment'] : "Choose file"; ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row d-flex justify-content-center mt-5">
                                            <button type="submit" class="btn btn-primary" id="save_btn" name="save" value="Save Data" style="background-color: #098209; border: none; width: 100px; color: #FFFFFF;">Update</button>
                                            <a href="files-meetingminutes.php" class="btn btn-danger ml-2" id="cancel_btn" name="cancel" value="Cancel" style="background-color: red; border: none; width: 100px; color: #FFFFFF;">Cancel</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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


    <script>
        function updateFileName(labelId) {
            const fileInput = document.getElementById(labelId.replace("Label", ""));
            const fileName = fileInput.files.length > 0 ? fileInput.files[0].name : "Choose file";
            document.getElementById(labelId).textContent = fileName;
        }
    </script>
    
</body>

</html>