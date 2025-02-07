<?php

if(isset($_POST['save'])){
    include("connect.php");
    error_reporting(0);
    session_start();

    $resoNo = $_POST['resoNo'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $dateAdopted = $_POST['dateAdopted'];
    $authorSponsor = $_POST['authorSponsor'];
    $remarks = $_POST['remarks'];
    $dateApproved = $_POST['dateApproved'];

    $sql = "INSERT INTO `resolution`(`reso_no`, `title`, `descrip`, `d_adopted`, `author_sponsor`, `remarks`, `d_approved`) 
            VALUES ('$resoNo', '$title', '$description', '$dateAdopted', '$authorSponsor', '$remarks', '$dateApproved')";

    $query = mysqli_query($conn, $sql);    

    if($query) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Resolution Created',
                        text: 'The resolution has been successfully created.',
                        confirmButtonText: 'OK'
                    });
                });
              </script>";
    } else {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an error creating the resolution.',
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
                                    <form action="addresolution.php" method="post">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color: #000000">Resolution No. / MO No.:</label>
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
                                            <label class="col-sm-3 col-form-label" style="color:#000000">Date Adopted:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" placeholder="Please type here..." id="dateAdopted" name="dateAdopted">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color: #000000">Author / Sponsor:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Please type here..." id="authorSponsor" name="authorSponsor">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color: #000000">Remarks:</label>
                                            <div class="col-sm-9">
                                                <select id="remarks" name="remarks" class="form-control">
                                                    <option selected>Choose...</option>
                                                    <option>Draft</option>
                                                    <option>Referred to Committee</option>
                                                    <option>Approved</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color:#000000">Date Approved:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" placeholder="Please type here..." id="dateApproved" name="dateApproved">
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="background-color: #098209;"> <i class="fa fa-paperclip"></i></span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="attachment" name="attachment">
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10 mt-4 justify">
                                                <button type="submit" class="btn btn-primary" id="save_btn" name="save" value="Save Data">Save</button>
                                                <a href="files-resolution.php">
                                                    <button type="button" class="btn btn-primary" id="cancel_btn" name="cancel" value="Cancel">Cancel</button>
                                                </a>
                                                
                                            </div>
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


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <!-- <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Quixkit</a> 2019</p> -->
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
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
    
</body>

</html>