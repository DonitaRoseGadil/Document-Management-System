<?php

if(isset($_POST['save'])){
    include("connect.php");
    error_reporting(0);
    session_start();

    $resoNo = $_POST['resoNo'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $authorSponsor = $_POST['authorSponsor'];
    $coAuthor = $_POST['coAuthor'];
    $remarks = $_POST['remarks'];
    $dateFowarded = $_POST['dateFowarded'];
    $dateSigned = $_POST['dateSigned'];
    $dateApproved = $_POST['dateApproved'];
    $attachmentPath = "";

    if (!empty($_FILES['attachment']['name'])) {
        $attachmentPath = "uploads/" . basename($_FILES['attachment']['name']);
        move_uploaded_file($_FILES['attachment']['tmp_name'], $attachmentPath);
    }
    
    $sql = "INSERT INTO resolution (reso_no, title, descrip, author_sponsor, co_author, remarks, d_forward, d_signed, d_approved, attachment) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $resoNo, $title, $description, $authorSponsor, $coAuthor, $remarks, $dateFowarded, $dateSigned, $dateApproved, $attachmentPath);

    if ($stmt->execute()) {
        $last_id = $conn->insert_id;

        // Insert into History Log
        $log_sql = "INSERT INTO history_log (action, file_type, file_id, title) 
                    VALUES ('Created', 'Resolution', ?, ?)";
        $log_stmt = $conn->prepare($log_sql);
        $log_stmt->bind_param("is", $last_id, $title);
        $log_stmt->execute();
        $log_stmt->close();

        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Resolution Created',
                    text: 'The resolution have been successfully created.',
                    confirmButtonText: 'OK'
                }).then(() => { window.location.href = 'files-resolution.php'; });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was an error creating the resolution.',
                    confirmButtonText: 'OK'
                });
              </script>";
    }

    $stmt->close();
    $conn->close();
}
 
?>

<!DOCTYPE html>
<html lang="en">

<?php include "header.php"; ?>

<head>
    <!-- Include SweetAlert CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
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
                                <h4 class="card-title text-center" style="color: #098209; ">ADD RESOLUTION</h4>
                            </div>
                            
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="addresolution.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color: #000000">Resolution No.:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Please type here..." id="resoNo" name="resoNo">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color:#000000">Title:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Please type here..." id="title" name="title">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color:#000000">Description:</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" style="resize: none;" rows="4" placeholder="Please type here..." id="description" name="description"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color: #000000">Author / Sponsor:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Please type here..." id="authorSponsor" name="authorSponsor">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color: #000000">Co-Author:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Please type here..." id="coAuthor" name="coAuthor">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color: #000000">Status:</label>
                                            <div class="col-sm-9">
                                                <select id="remarks" name="remarks" class="form-control" onchange="toggleDateFields()">
                                                    <option selected>Choose...</option>
                                                    <option>Forwarded to LCE</option>
                                                    <option>Signed by LCE</option>
                                                    <option>SB Approval</option>
                                                    <option>Disapprove</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="dateFields" style="display: none;">
                                            <div class="form-group row" style="visibility: hidden; opacity: 0;" id="forwardedDateField">
                                                <label class="col-sm-3 col-form-label" style="color:#000000;">Date Forwarded to LCE:</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="dateFowarded" name="dateFowarded">
                                                </div>
                                            </div>
                                            <div class="form-group row" style="visibility: hidden; opacity: 0;" id="signedDateField">
                                                <label class="col-sm-3 col-form-label" style="color:#000000">Date Signed by LCE:</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="dateSigned" name="dateSigned">
                                                </div>
                                            </div>
                                            <div class="form-group row" style="visibility: hidden; opacity: 0;" id="sbApprovalDateField">
                                                <label class="col-sm-3 col-form-label" style="color:#000000">SB Approval:</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="dateApproved" name="dateApproved">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="background-color: #098209;"> <i class="fa fa-paperclip"></i></span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="attachment" name="attachment" onchange="updateFileName()">
                                                <label class="custom-file-label" for="attachment">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="form-group row d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary" id="save_btn" name="save" value="Save Data" style="background-color: #098209; border: none; width: 100px; color: #FFFFFF;">Save</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        function updateFileName() {
            const fileInput = document.getElementById('attachment');
            const fileName = fileInput.files[0].name;
            const label = document.querySelector('.custom-file-label');
            label.textContent = fileName;
        }

        function toggleDateFields() {
            var status = document.getElementById("remarks").value;

            // Hide all fields first
            document.getElementById("forwardedDateField").style.visibility = "hidden";
            document.getElementById("forwardedDateField").style.opacity = "0";
            
            document.getElementById("signedDateField").style.visibility = "hidden";
            document.getElementById("signedDateField").style.opacity = "0";

            document.getElementById("sbApprovalDateField").style.visibility = "hidden";
            document.getElementById("sbApprovalDateField").style.opacity = "0";

            // Show the corresponding field based on selected option
            if (status === "Forwarded to LCE") {
                document.getElementById("forwardedDateField").style.visibility = "visible";
                document.getElementById("forwardedDateField").style.opacity = "1";
                document.getElementById("dateFields").style.display = "block";
                document.getElementById("signedDateField").style.display = "none";
                document.getElementById("sbApprovalDateField").style.display = "none";
            } else if (status === "Signed by LCE") {
                document.getElementById("forwardedDateField").style.visibility = "visible";
                document.getElementById("forwardedDateField").style.opacity = "1";
                document.getElementById("signedDateField").style.visibility = "visible";
                document.getElementById("signedDateField").style.opacity = "1";
                document.getElementById("dateFields").style.display = "block";
                document.getElementById("signedDateField").style.display = "flex";
                document.getElementById("sbApprovalDateField").style.display = "none";
            } else if (status === "SB Approval") {
                document.getElementById("forwardedDateField").style.visibility = "visible";
                document.getElementById("forwardedDateField").style.opacity = "1";
                document.getElementById("signedDateField").style.visibility = "visible";
                document.getElementById("signedDateField").style.opacity = "1";
                document.getElementById("sbApprovalDateField").style.visibility = "visible";
                document.getElementById("sbApprovalDateField").style.opacity = "1";
                document.getElementById("dateFields").style.display = "block";
                document.getElementById("forwardedDateField").style.display = "flex";
                document.getElementById("signedDateField").style.display = "flex";
                document.getElementById("sbApprovalDateField").style.display = "flex";
            } else {
                document.getElementById("dateFields").style.display = "none";
            }
        }
    </script>
    
</body>

</html>