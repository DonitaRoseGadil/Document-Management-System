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
                        <h5 class="card-title flex-grow-1 fs-4 fw-bold text-dark text-center" style="color: #000000">VIEW RESOLUTION</h5>
                    </div>
                    <?php 
                        include "connect.php";
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM resolution WHERE id = $id LIMIT 1";
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
                                        <label class="col-sm-3 col-form-label" style="color: #000000">Resolution No.:</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $row['reso_no']?>" id="resoNo" name="resoNo">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" style="color:#000000">Date Approved:</label>
                                        <div class="col-sm-9">
                                            <input type="date" readonly class="form-control-plaintext" value="<?php echo $row['d_approved']?>" id="dateApproved" name="dateApproved">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" style="color:#000000">Title:</label>
                                        <div class="col-sm-9">
                                            <textarea readonly class="form-control-plaintext" id="title" name="title" rows="3" style="resize: none; overflow: hidden;"><?php echo $row['title']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" style="color:#000000">Description:</label>
                                        <div class="col-sm-9">
                                            <textarea readonly class="form-control-plaintext" id="descrip" name="descrip" rows="3" style="resize: none; overflow: hidden;"><?php echo $row['descrip']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" style="color: #000000">Author / Sponsor:</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $row['author_sponsor']?>" id="authorSponsor" name="authorSponsor">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" style="color: #000000">Co-Author:</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $row['co_author']?>" id="coAuthor" name="coAuthor">
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
                                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $row['remarks']?>" id="remarks" name="remarks">
                                        </div>
                                    </div>
                                    <!-- <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="background-color: #098209;"> <i class="fa fa-paperclip"></i></span>
                                        </div>
                                        <?php
                                            include "connect.php";
                                            $filePath = $row['attachment']; 
                                            $fileName = basename($filePath); 
                                        ?>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="attachment" name="attachment" name="attachment" onchange="updateFileName()" disabled>
                                            <label class="custom-file-label" for="attachment"><?php echo $fileName ? $fileName : "Choose file"; ?></label>
                                        </div>
                                    </div> -->
                                    <div class="form-group row d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary" id="save_btn" name="save" value="Save Data" style="background-color: #098209; border: none; width: 100px; color: #FFFFFF;">Update</button>
                                        <a href="files-resolution.php" class="btn btn-danger ml-2" id="cancel_btn" name="cancel" value="Cancel" style="background-color: red; border: none; width: 100px; color: #FFFFFF;">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <div class="card-footer d-sm-flex justify-content-between">
                        <div class="card-footer-link mb-4 mb-sm-0">
                            <p class="card-text text-dark d-inline">Last updated 3 mins ago</p>
                        </div>

                        <a href="viewfile.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View File</a>
                    </div>
                </div> 
                <!-- <div class="card">
                    <div class="card-body">
                        <?php
                        include("connect.php"); // Include database connection

                        if (isset($_GET['id'])) {
                            $id = intval($_GET['id']); // Prevent SQL injection

                            // Fetch file path from the database
                            $sql = "SELECT attachment FROM resolution WHERE id = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $id);
                            $stmt->execute();
                            $stmt->bind_result($file);
                            $stmt->fetch();
                            $stmt->close();

                            if ($file) {
                                $filePath = "files/" . $file;

                                if (file_exists($filePath)) {
                                    $fileExt = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

                                    if ($fileExt == "pdf") {
                                        echo "<embed src='$filePath' type='application/pdf' width='100%' height='600px' />";
                                    } else {
                                        echo "Unsupported file format.";
                                    }
                                } else {
                                    echo "File not found.";
                                }
                            } else {
                                echo "No file associated with this record.";
                            }

                            $conn->close();
                        } else {
                            echo "Invalid request.";
                        }
                        ?>
                    </div>
                </div> -->

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