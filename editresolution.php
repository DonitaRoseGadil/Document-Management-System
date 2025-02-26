<?php

if(isset($_POST['save'])){
    include("connect.php");
    error_reporting(0);
    session_start();

    $reso = $_GET['resoNo'];

    $id = $_GET['id'];

    //$id = intval($_POST['id']);
    $resoNo = $_POST['resoNo'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $authorSponsor = $_POST['authorSponsor'];
    $coAuthor = $_POST['coAuthor'];
    $remarks = $_POST['remarks'];
    $dateApproved = $_POST['dateApproved'];
    $attachment = '';

    if (!empty($_FILES['attachment']['name'])) {
        $type = $_FILES['attachment']['type'];
        if ($type == 'application/pdf' || $type == 'application/msword'|| $type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
            $attachment = $_FILES['attachment']['name'];
            if ($attachment != '') {
                move_uploaded_file($_FILES['attachment']['tmp_name'], 'files/'.$attachment);
            }
        } else {
            echo '
            <div class="form-group row" style="display: block;">
                <div class="col-sm-9">
                    <div class="alert alert-danger"><strong>Error: </strong> Only Supported Files (PDF and DOCX).</div>
                </div>
            </div>';
        }
    }

    $sql = "UPDATE `resolution` SET 
    `reso_no`='$resoNo', 
    `title`='$title', 
    `descrip`='$description', 
    `author_sponsor`='$authorSponsor', 
    `co_author`='$coAuthor', 
    `remarks`='$remarks', 
    `d_approved`='$dateApproved'";

    if (!empty($attachment)) {
        $sql .= ", `attachment`='$attachment'";
    }

    $sql .= " WHERE id = $id";

    $query = mysqli_query($conn, $sql);  
    
    $log_sql = "INSERT INTO history_log (action, file_type, file_id, title) 
            VALUES ('Edited', 'Resolution', $id, '$title')";
    $conn->query($log_sql);


    if($query) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Resolution Updated',
                        text: 'The resolution has been successfully updated.',
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
                        text: 'There was an error updating the resolution.',
                        confirmButtonText: 'OK'
                    });
                });
              </script>";
        header("Location: files-resolution.php");
        exit;    
    }
}    
?>

<!DOCTYPE html>
<html lang="en">

<?php include "header.php"; ?>

<head>
    <!-- Include SweetAlert CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const requiredFields = ["resoNo", "title", "description", "authorSponsor", "coAuthor", "dateApproved", "remarks"];

        function validateField(field) {
            let inputElement = document.getElementById(field);
            let errorElement = document.getElementById(field + "-error");

            if (!inputElement.value.trim() || (field === "remarks" && inputElement.value === "Choose...")) {
                if (!errorElement) {
                    let errorMsg = document.createElement("div");
                    errorMsg.id = field + "-error";
                    errorMsg.className = "text-danger mt-1";
                    errorMsg.textContent = "Required missing field.";
                    inputElement.parentNode.appendChild(errorMsg);
                }
            } else {
                if (errorElement) {
                    errorElement.remove();
                }
            }
        }

        // Add event listeners for real-time validation
        requiredFields.forEach(function (field) {
            let inputElement = document.getElementById(field);

            if (inputElement) {
                // "input" event - Hide error while typing
                inputElement.addEventListener("input", function () {
                    validateField(field);
                });

                // "change" event for dropdown validation
                if (field === "remarks") {
                    inputElement.addEventListener("change", function () {
                        validateField(field);
                    });
                }

                // "focusout" event - Show error if empty when user leaves field
                inputElement.addEventListener("focusout", function () {
                    validateField(field);
                });
            }
        });

        // Form submit validation
        document.querySelector("form").addEventListener("submit", function (event) {
            let isValid = true;
            requiredFields.forEach(function (field) {
                validateField(field);
                if (!document.getElementById(field).value.trim() || 
                    (field === "remarks" && document.getElementById(field).value === "Choose...")) {
                    isValid = false;
                }
            });

            if (!isValid) {
                event.preventDefault();
            }
        });
    });
</script>

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
                                <h4 class="card-title text-center" style="color: #098209; ">EDIT RESOLUTION</h4>
                            </div>
                            <?php 
                                include "connect.php";
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM resolution WHERE id = $id LIMIT 1";
                                $result= mysqli_query($conn, $sql);   
                                $row = mysqli_fetch_assoc($result); 

                                $sql2 = "SELECT remarks FROM resolution WHERE id = '$id'";
                                $result2 = mysqli_query($conn, $sql2);
                                $row2 = mysqli_fetch_assoc($result2);


                                $selectedRemarks = $row2['remarks']; 
                            ?>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <input type="hidden" class="form-control" value="<?php echo $row['id']?>" id="id" name="id">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color: #000000">Resolution No.:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="<?php echo $row['reso_no']?>" id="resoNo" name="resoNo">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color:#000000">Date Approved:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" value="<?php echo $row['d_approved']?>" id="dateApproved" name="dateApproved">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color:#000000">Title:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="<?php echo $row['title']?>" id="title" name="title">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color:#000000">Description:</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" style="resize: none;" rows="4" id="description" name="description"><?php echo htmlspecialchars($row['descrip']); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color: #000000">Author / Sponsor:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="<?php echo $row['author_sponsor']?>" id="authorSponsor" name="authorSponsor">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color: #000000">Co-Author:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Please type here..." value="<?php echo $row['co_author']?>" id="coAuthor" name="coAuthor">
                                            </div>
                                        </div>
                                        <?php 
                                            include "connect.php";
                                            $id = $_GET['id'];
                                            $sql = "SELECT * FROM resolution WHERE id = $id LIMIT 1";
                                            $result= mysqli_query($conn, $sql);   
                                            $row = mysqli_fetch_assoc($result); 

                                            $sql2 = "SELECT remarks FROM resolution WHERE id = '$id'";
                                            $result2 = mysqli_query($conn, $sql2);
                                            $row2 = mysqli_fetch_assoc($result2);
                                            $selectedRemarks = $row2['remarks']; 
                                        ?>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color: #000000">Status:</label>
                                            <div class="col-sm-9">
                                                <select id="remarks" name="remarks" class="form-control">
                                                    <option value="" <?php echo ($selectedRemarks == '') ? 'selected' : ''; ?>>Choose...</option>
                                                    <option value="Draft" <?php echo ($selectedRemarks == 'Draft') ? 'selected' : ''; ?>>Draft</option>
                                                    <option value="Information" <?php echo ($selectedRemarks == 'Information') ? 'selected' : ''; ?>>Information</option>
                                                    <option value="Referred to Committee" <?php echo ($selectedRemarks == 'Referred to Committee') ? 'selected' : ''; ?>>Referred to Committee</option>
                                                    <option value="Approved" <?php echo ($selectedRemarks == 'Approved') ? 'selected' : ''; ?>>Approved</option>
                                                  </select>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="background-color: #098209;"> <i class="fa fa-paperclip"></i></span>
                                            </div>
                                            <?php
                                                include "connect.php";
                                                $filePath = $row['attachment']; 
                                                $fileName = basename($filePath); 
                                            ?>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="attachment" name="attachment" name="attachment" onchange="updateFileName()">
                                                <label class="custom-file-label" for="attachment"><?php echo $fileName ? $fileName : "Choose file"; ?></label>
                                            </div>
                                        </div>
                                        <div class="form-group row d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary" id="save_btn" name="save" value="Save Data" style="background-color: #098209; border: none; width: 100px; color: #FFFFFF;">Update</button>
                                            <a href="files-resolution.php" class="btn btn-danger ml-2" id="cancel_btn" name="cancel" value="Cancel" style="background-color: red; border: none; width: 100px; color: #FFFFFF;">Cancel</a>
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