<?php

if(isset($_POST['save'])){
    include("connect.php");
    error_reporting(0);
    session_start();

    $mo_no = $_GET['mo_no'];

    $id = intval($_POST['id']);
    $moNo = $_POST['moNo'];
    $title = $_POST['title'];
    $dateAdopted = $_POST['dateAdopted'];
    $authorSponsor = $_POST['authorSponsor'];
    $coAuthor = $_POST['coAuthor'];
    $remarks = $_POST['remarks'];
    $dateApproved = $_POST['dateApproved'];

    $sql = "UPDATE `ordinance` SET `mo_no`='$moNo', `title`='$title', `d_Adopted`='$dateAdopted', `author_sponsor`='$authorSponsor', `co_author`='$coAuthor', `remarks`='$remarks', `d_approved`='$dateApproved' WHERE id = $id";

    $query = mysqli_query($conn, $sql);
    
    $log_sql = "INSERT INTO history_log (action, file_type, file_id, title) 
    VALUES ('Edited', 'Ordinance', $id, '$title')";
    $conn->query($log_sql);

    if($query) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Ordinance Created',
                        text: 'The ordinance has been successfully Updated.',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'files-ordinances.php';
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
                        text: 'There was an error updating the ordinance.',
                        confirmButtonText: 'OK'
                    });
                });
              </script>";
        header("Location: files-ordinances.php");
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
        const requiredFields = ["moNo", "title", "dateAdopted", "authorSponsor", "coAuthor", "remarks", "dateApproved"];

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
                                <h4 class="card-title text-center" style="color: #098209; ">EDIT ORDINANCE</h4>
                            </div>
                            <?php 
                                include "connect.php";
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM ordinance WHERE id = $id LIMIT 1";
                                $result= mysqli_query($conn, $sql);   
                                $row = mysqli_fetch_assoc($result); 
                            ?>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="" method="post">
                                    <div class="form-group row">
                                            <div class="col-sm-9">
                                                <input type="hidden" class="form-control" value="<?php echo $row['id']?>" id="id" name="id">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color: #000000">MO No.:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="<?php echo $row['mo_no']?>" id="moNo" name="moNo">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color:#000000">Date Adopted:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" value="<?php echo $row['d_adopted']?>" id="dateAdopted" name="dateAdopted">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color:#000000">Title:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="<?php echo $row['title']?>" id="title" name="title">
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color:#000000">Description:</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" style="resize: none;" rows="4" value=" id="description" name="description"></textarea>
                                            </div>
                                        </div> -->
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
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color: #000000">Status:</label>
                                            <div class="col-sm-9">
                                            <select id="remarks" name="remarks" class="form-control">
                                                <option value="Draft" <?php if ($row['remarks'] == "Draft") echo "selected"; ?>>Draft</option>
                                                <option value="Information" <?php if ($row['remarks'] == "Information") echo "selected"; ?>>Information</option>
                                                <option value="Referred to Committee" <?php if ($row['remarks'] == "Referred to Committee") echo "selected"; ?>>Referred to Committee</option>
                                                <option value="Approved" <?php if ($row['remarks'] == "Approved") echo "selected"; ?>>Approved</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color:#000000">Date Approved:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" value="<?php echo $row['d_approved']?>" id="dateApproved" name="dateApproved">
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="background-color: #098209;"> <i class="fa fa-paperclip"></i></span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="attachment" name="attachment" name="attachment" onchange="updateFileName()">
                                                <label class="custom-file-label" for="attachment">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="form-group row d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary" id="save_btn" name="save" value="Save Data" style="background-color: #098209; border: none; width: 100px; color: #FFFFFF;">Update</button>
                                            <a href="files-ordinances.php" class="btn btn-danger ml-2" id="cancel_btn" name="cancel" value="Cancel" style="background-color: red; border: none; width: 100px; color: #FFFFFF;">Cancel</a>
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