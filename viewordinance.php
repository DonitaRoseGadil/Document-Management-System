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
                                <h4 class="card-title text-center" style="color: #098209; ">VIEW ORDINANCE</h4>
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
                                            <label class="col-sm-3 col-form-label" style="color: #000000">Resolution No. / MO No.: </label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="<?php echo $row['mo_no']?>" id="moNo" name="moNo">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color:#000000">Title:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="<?php echo $row['title']?>" id="title" name="title">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color:#000000">Date Adopted:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" value="<?php echo $row['date_adopted']?>" id="dateAdopted" name="dateAdopted">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color: #000000">Author / Sponsor:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="<?php echo $row['author_sponsor']?>" id="authorSponsor" name="authorSponsor">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color:#000000">Date Forwarded to LCE: </label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" value="<?php echo $row['date_fwd']?>" id="dateFwd" name="dateFwd">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color:#000000">Date Signed by LCE: </label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" value="<?php echo $row['date_signed']?>" id="dateSigned" name="dateSigned">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color:#000000">SP Approval: </label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="<?php echo $row['sp_approval']?>" id="spApproval" name="spApproval">
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" value="<?php echo $row['attachment']; ?>" id="attachment" name="attachment" disabled>
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" style="background-color: #098209; border: none; outline: none;" type="button" onclick="viewFile('<?php echo $row['id']; ?>', 'attachment')">View File</button>
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
        function viewFile(id, field) {
            let filePath = document.getElementById(field).value;
            
            if (!filePath) {
                alert("No file available to view.");
                return;
            }

            // Check if filePath is a direct URL or stored in the database
            if (filePath.startsWith("http") || filePath.endsWith(".pdf")) {
                window.open(filePath, '_blank');  // Open direct URL
            } else {
                window.open(`fetch_pdf.php?id=${id}&field=${field}`, '_blank'); // Fetch from database
            }
        }
    </script>
    
    
</body>

</html>