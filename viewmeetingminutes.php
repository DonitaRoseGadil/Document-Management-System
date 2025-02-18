<?php

    if(isset($_POST['save'])) {
        include("connect.php");
        error_reporting(0);
        session_start();

        $id = intval($_POST['id']);
        $no_regSession = $_POST['no_regSession'];
        $date = $_POST['date'];
        $genAttachment = $_POST['genAttachment'];
        $resNo = $_POST['resNo'];
        $title = $_POST['title'];
        $type = $_POST['type'];
        $status = $_POST['status'];
        $attachment = $_POST['attachment'];

        $sql = "UPDATE `minutes` SET `no_regSession`=`$no_regSession`,
                                    `date`=`$date`,
                                    `genAttachment`=`$genAttachment`,
                                    `resNo`=`$resNo`,
                                    `title`=`$title`,
                                    `type`=`$type`,
                                    `status`=`$status`,
                                    `attachment`=`$attachment` WHERE `id`=`$id`";

        $query = mysqli_query($conn, $sql);

        if($query) {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Meeting Minutes Updated',
                            text: 'The minutes has been successfully updated.',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'files-resolution.php';
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
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM `minutes` WHERE id = $id LIMIT 1";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                            ?>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
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
                                                <input type="file" class="custom-file-input" value="<?php echo $row['genAttachment']?>" id="genAttachment" name="genAttachment" onchange="updateFileName()">
                                                <label class="custom-file-label" for="genAttachment">Choose file</label>
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
                                                <input type="file" class="custom-file-input" value="<?php echo $row['attachment']?>" id="attachment" name="attachment" onchange="updateFileName()">
                                                <label class="custom-file-label" for="attachment">Choose file</label>
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
        function updateFileName() {
            const fileInput = document.getElementById('attachment');
            const fileName = fileInput.files[0].name;
            const label = document.querySelector('.custom-file-label');
            label.textContent = fileName;
        }
    </script>
    
</body>

</html>