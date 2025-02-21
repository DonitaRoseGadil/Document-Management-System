<?php
include("connect.php");
session_start();
error_reporting(0);

// Initialize variables
$mode = "add"; // Default to add mode
$resoNo = $title = $description = $authorSponsor = $coAuthor = $remarks = $dateApproved = $attachment = "";

// Check if editing or viewing a record
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $mode = isset($_GET['edit']) ? "edit" : "view"; 

    // Fetch existing data
    $sql = "SELECT * FROM resolution WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $resoNo = $row['reso_no'];
        $title = $row['title'];
        $description = $row['descrip'];
        $authorSponsor = $row['author_sponsor'];
        $coAuthor = $row['co_author'];
        $remarks = $row['remarks'];
        $dateApproved = $row['d_approved'];
        $attachment = $row['attachment'];
    }
    mysqli_stmt_close($stmt);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resoNo = mysqli_real_escape_string($conn, $_POST['resoNo']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $authorSponsor = mysqli_real_escape_string($conn, $_POST['authorSponsor']);
    $coAuthor = mysqli_real_escape_string($conn, $_POST['coAuthor']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
    $dateApproved = mysqli_real_escape_string($conn, $_POST['dateApproved']);
    
    // File upload handling
    if (!empty($_FILES['attachment']['name'])) {
        $fileType = $_FILES['attachment']['type'];
        $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

        if (in_array($fileType, $allowedTypes)) {
            $attachment = $_FILES['attachment']['name'];
            $targetPath = 'files/' . basename($attachment);
            move_uploaded_file($_FILES['attachment']['tmp_name'], $targetPath);
        } else {
            echo "<script>Swal.fire('Error', 'Only PDF and DOCX files are allowed.', 'error');</script>";
            exit();
        }
    }

    if (isset($_POST['save'])) { // Add New
        $sql = "INSERT INTO resolution (reso_no, title, descrip, author_sponsor, co_author, remarks, d_approved, attachment) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssss", $resoNo, $title, $description, $authorSponsor, $coAuthor, $remarks, $dateApproved, $attachment);
    } elseif (isset($_POST['update'])) { // Update
        $sql = "UPDATE resolution SET reso_no=?, title=?, descrip=?, author_sponsor=?, co_author=?, remarks=?, d_approved=?, attachment=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssssi", $resoNo, $title, $description, $authorSponsor, $coAuthor, $remarks, $dateApproved, $attachment, $_POST['id']);
    }

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>Swal.fire('Success', 'Resolution saved successfully.', 'success').then(() => window.location.href='resolution.php');</script>";
    } else {
        echo "<script>Swal.fire('Error', 'Something went wrong.', 'error');</script>";
    }
    mysqli_stmt_close($stmt);
}

// Handle Delete
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM resolution WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>Swal.fire('Deleted', 'Resolution deleted successfully.', 'success').then(() => window.location.href='resolution.php');</script>";
    } else {
        echo "<script>Swal.fire('Error', 'Could not delete resolution.', 'error');</script>";
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<?php include "header.php"; ?>

<head>
    <!-- Include SweetAlert CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>

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
                                <h4 class="card-title text-center" style="color: #098209; "><?= ucfirst($mode); ?>RESOLUTION</h4>
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
                                            <label class="col-sm-3 col-form-label" style="color:#000000">Date Approved:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" placeholder="Please type here..." id="dateApproved" name="dateApproved">
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
                                                <select id="remarks" name="remarks" class="form-control">
                                                    <option selected>Choose...</option>
                                                    <option>Draft</option>
                                                    <option>Information</option>
                                                    <option>Referred to Committee</option>
                                                    <option>Approved</option>
                                                </select>
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