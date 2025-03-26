<!DOCTYPE html>
<html lang="en">

<?php include "header.php"; ?>

<body>

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php include "sidebar.php"; ?>

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
                                    <?php
                                        if (isset($_POST['save'])) {
                                            include("connect.php");

                                            $resoNo = $_POST['resoNo'];
                                            $title = $_POST['title'];
                                            $dateAdopted = $_POST['dateAdopted'];
                                            $authorSponsor = $_POST['authorSponsor'];
                                            $coAuthor = $_POST['coAuthor'];
                                            $remarks = $_POST['remarks'];
                                            $notes = $_POST['notes'];
                                            $dateForwarded = $_POST['dateForwarded'];
                                            $dateSigned = $_POST['dateSigned'];
                                            $spResoNo = $_POST['spResoNo'];
                                            $dateApproved = $_POST['dateApproved'];
                                            $attachmentPath = "";

                                            if (!empty($_FILES['attachment']['name'])) {
                                                $attachmentPath = "uploads/" . basename($_FILES['attachment']['name']);
                                                move_uploaded_file($_FILES['attachment']['tmp_name'], $attachmentPath);
                                            }

                                            // Check if Resolution No. OR Title already exists (case insensitive)
                                            $check_sql = "SELECT * FROM resolution WHERE LOWER(reso_no) = LOWER(?) AND LOWER(title) = LOWER(?)";
                                            $stmt_check = $conn->prepare($check_sql);
                                            $stmt_check->bind_param("ss", $resoNo, $title);
                                            $stmt_check->execute();
                                            $result = $stmt_check->get_result();

                                            if ($result->num_rows > 0) {
                                                // Resolution No. or Title already exists
                                                echo "<script>
                                                        Swal.fire({
                                                            icon: 'warning',
                                                            title: 'Duplicate Entry!',
                                                            text: 'The Resolution No. or Title already exists.',
                                                            confirmButtonText: 'OK'
                                                        });
                                                    </script>";
                                            } else {
                                                // Insert new resolution
                                                $sql = "INSERT INTO resolution (reso_no, title, d_adopted, author_sponsor, co_author, remarks, d_forward, d_signed, sp_resoNo, d_approved, attachment, notes) 
                                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                                
                                                $stmt = $conn->prepare($sql);
                                                $stmt->bind_param("ssssssssssss", $resoNo, $title, $dateAdopted, $authorSponsor, $coAuthor, $remarks, $dateForwarded, $dateSigned, $spResoNo, $dateApproved, $attachmentPath, $notes);

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
                                                                text: 'The resolution has been successfully created.',
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
                                            }

                                            $stmt_check->close();
                                            $conn->close();
                                        }
                                        ?>


                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color: #000000">Resolution No.:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Please type here..." id="resoNo" name="resoNo">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                             <label class="col-sm-3 col-form-label" style="color:#000000">Title:</label>
                                             <div class="col-sm-9">
                                                 <textarea class="form-control" style="resize: none;" rows="4" placeholder="Please type here..." id="title" name="title"></textarea>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color:#000000;">Date Adopted:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" id="dateAdopted" name="dateAdopted">
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
                                                    <option>SP Approval</option>
                                                    <option>Disapprove</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="dateFields" style="display: none;">
                                            <div class="form-group row" style="visibility: hidden; opacity: 0;" id="forwardedDateField">
                                                <label class="col-sm-3 col-form-label" style="color:#000000;">Date Forwarded to LCE:</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="dateForwarded" name="dateForwarded">
                                                </div>
                                            </div>
                                            <div class="form-group row" style="visibility: hidden; opacity: 0;" id="notesField">
                                                <label class="col-sm-3 col-form-label" style="color:#000000">Remarks/Notes:</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" style="resize: none;" rows="4" placeholder="Please type here..." id="notes" name="notes"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row" style="visibility: hidden; opacity: 0;" id="signedDateField">
                                                <label class="col-sm-3 col-form-label" style="color:#000000">Date Signed by LCE:</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="dateSigned" name="dateSigned">
                                                </div>
                                            </div>
                                            <div class="form-group row" style="visibility: hidden; opacity: 0;" id="spResoNoField">
                                                <label class="col-sm-3 col-form-label" style="color:#000000">SP Resolution No:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" placeholder="Please type here..." id="spResoNo" name="spResoNo">
                                                </div>
                                            </div>
                                            <div class="form-group row" style="visibility: hidden; opacity: 0;" id="sbApprovalDateField">
                                                <label class="col-sm-3 col-form-label" style="color:#000000">SP Approval:</label>
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
                                                <label class="custom-file-label text-truncate" style="overflow:hidden; text-overflow:ellipsis; white-space:nowrap; display:block;" for="attachment">Choose file</label>
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
            document.getElementById("spResoNoField").style.visibility = "hidden";
            document.getElementById("spResoNoField").style.opacity = "0";
            document.getElementById("notesField").style.visibility = "hidden";
            document.getElementById("notesField").style.opacity = "0";
            
            // Show the corresponding field based on selected option
            if (status === "Forwarded to LCE") {
                document.getElementById("forwardedDateField").style.visibility = "visible";
                document.getElementById("forwardedDateField").style.opacity = "1";
                document.getElementById("dateFields").style.display = "block";
                document.getElementById("signedDateField").style.display = "none";
                document.getElementById("spResoNoField").style.display = "none";
                document.getElementById("sbApprovalDateField").style.display = "none";
                document.getElementById("notesField").style.display = "none";
            } else if (status === "Signed by LCE") {
                document.getElementById("forwardedDateField").style.visibility = "visible";
                document.getElementById("forwardedDateField").style.opacity = "1";
                document.getElementById("signedDateField").style.visibility = "visible";
                document.getElementById("signedDateField").style.opacity = "1";
                document.getElementById("dateFields").style.display = "block";
                document.getElementById("signedDateField").style.display = "flex";
                document.getElementById("spResoNoField").style.display = "none";
                document.getElementById("sbApprovalDateField").style.display = "none";
                document.getElementById("notesField").style.display = "none";
            } else if (status === "SP Approval") {
                document.getElementById("forwardedDateField").style.visibility = "visible";
                document.getElementById("forwardedDateField").style.opacity = "1";
                document.getElementById("signedDateField").style.visibility = "visible";
                document.getElementById("signedDateField").style.opacity = "1";
                document.getElementById("sbApprovalDateField").style.visibility = "visible";
                document.getElementById("sbApprovalDateField").style.opacity = "1";
                document.getElementById("spResoNoField").style.visibility = "visible";
                document.getElementById("spResoNoField").style.opacity = "1";
                document.getElementById("dateFields").style.display = "block";
                document.getElementById("forwardedDateField").style.display = "flex";
                document.getElementById("signedDateField").style.display = "flex";
                document.getElementById("spResoNoField").style.display = "flex";
                document.getElementById("sbApprovalDateField").style.display = "flex";
                document.getElementById("notesField").style.display = "none";
            } else if (status === "Disapprove") {
                document.getElementById("dateFields").style.display = "block";
                document.getElementById("forwardedDateField").style.display = "none";
                document.getElementById("signedDateField").style.display = "none";
                document.getElementById("spResoNoField").style.display = "none";
                document.getElementById("sbApprovalDateField").style.display = "none";
                document.getElementById("notesField").style.visibility = "visible";
                document.getElementById("notesField").style.opacity = "1";
                document.getElementById("notesField").style.display = "flex";
                
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");
        const requiredFields = ["moNo", "title", "dateAdopted", "authorSponsor"];

        function validateField(field) {
            let inputElement = document.getElementById(field);
            if (!inputElement) return true; // Skip if field is missing

            let errorElement = document.getElementById(field + "-error");
            let isEmpty = !inputElement.value.trim() || (field === "remarks" && inputElement.value === "Choose...");

            if (isEmpty) {
                if (!errorElement) {
                    let errorMsg = document.createElement("div");
                    errorMsg.id = field + "-error";
                    errorMsg.className = "text-danger mt-1";
                    errorMsg.textContent = "Required field.";
                    inputElement.parentNode.appendChild(errorMsg);
                }
                return false; // Field is invalid
            } else {
                if (errorElement) errorElement.remove();
                return true; // Field is valid
            }
        }

        function validateForm(event) {
            let isValid = true;
            let firstInvalidField = null; // Store the first empty field

            requiredFields.forEach(function (field) {
                if (!validateField(field)) {
                    isValid = false;
                    if (!firstInvalidField) firstInvalidField = field; // Capture the first invalid field
                }
            });

            if (!isValid) {
                event.preventDefault(); // Stop submission

                // SweetAlert2 Alert
                Swal.fire({
                    icon: 'warning',
                    title: 'Incomplete Form',
                    text: 'All required fields must be filled out before submitting!',
                    confirmButtonText: 'OK'
                });

                // Scroll to the first invalid field
                if (firstInvalidField) {
                    document.getElementById(firstInvalidField).scrollIntoView({ behavior: "smooth", block: "center" });
                    document.getElementById(firstInvalidField).focus();
                }

                return false;
            }
        }

        // Add validation to fields
        requiredFields.forEach(function (field) {
            let inputElement = document.getElementById(field);
            if (inputElement) {
                inputElement.addEventListener("input", function () { validateField(field); });
                if (field === "remarks") inputElement.addEventListener("change", function () { validateField(field); });
                inputElement.addEventListener("focusout", function () { validateField(field); });
            }
        });

        // Prevent form submission
        form.addEventListener("submit", validateForm);
    });

    function updateMinDate(fieldId, targetIds) {
        let selectedDate = document.getElementById(fieldId).value;
        if (selectedDate) {
            targetIds.forEach(targetId => {
                document.getElementById(targetId).min = selectedDate;
            });
        }
    }

    document.getElementById("dateAdopted").addEventListener("change", function () {
        updateMinDate("dateAdopted", ["dateForwarded", "dateSigned", "dateApproved"]);
    });

    document.getElementById("dateForwarded").addEventListener("change", function () {
        updateMinDate("dateForwarded", ["dateSigned", "dateApproved"]);
    });

    document.getElementById("dateSigned").addEventListener("change", function () {
        updateMinDate("dateSigned", ["dateApproved"]);
    });
    
    </script>
    
</body>

</html>