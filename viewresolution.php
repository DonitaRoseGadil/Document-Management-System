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
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center p-3 mt-4">
                        <div class="button-container d-flex justify-content-end">
                            <p class="card-text text-dark d-inline">Last updated 3 mins ago</p>
                        </div>
                        
                    </div>
                    <h5 class="card-title flex-grow-1 fs-4 fw-bold text-dark text-center" style="color: #000000">VIEW RESOLUTION</h5>
                    <?php 
                        include "connect.php";
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM resolution WHERE id = $id LIMIT 1";
                        $result= mysqli_query($conn, $sql);   
                        $row = mysqli_fetch_assoc($result); 
                    ?>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="addresolution.php" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <input type="hidden" class="form-control" value="<?php echo $row['id']?>" id="id" name="id">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" style="color: #000000">Resolution No.:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="resoNo" name="resoNo" value="<?php echo $row['reso_no']?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" style="color:#000000">Date Approved:</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="dateApproved" name="dateApproved" value="<?php echo $row['d_approved']?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" style="color:#000000">Title:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title']?>" disabled>
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
                                        <input type="text" class="form-control" id="authorSponsor" name="authorSponsor" value="<?php echo $row['author_sponsor']?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" style="color: #000000">Co-Author:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="coAuthor" name="coAuthor" disabled>
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
                                    <button type="submit" class="btn btn-primary" id="save_btn" name="save" value="Save Data" style="background-color: #098209; border: none; width: 100px; color: #FFFFFF;">Edit</button>
                                    <a href="files-resolution.php" class="btn btn-danger ml-2" id="cancel_btn" name="cancel" value="Cancel" style="background-color: red; border: none; width: 100px; color: #FFFFFF;">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer d-sm-flex justify-content-between">
                        <div class="card-footer-link mb-4 mb-sm-0">
                            <p class="card-text text-dark d-inline">Last updated 3 mins ago</p>
                        </div>

                        <a href="javascript:void()" class="btn btn-primary">Go somewhere</a>
                    </div>
                    </div> 
                <!-- <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center p-3 mt-4">
                        <h1 class="card-title flex-grow-1 fs-4 fw-bold text-dark text-center" style="color: #000000">VIEW RESOLUTION</h1>
                    </div>
                    <div class="card-body">
                        <embed src="files/Workplan.pdf" type="application/pdf" width="100%" height="600px" />
                    </div> -->
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
    
</body>

</html> 