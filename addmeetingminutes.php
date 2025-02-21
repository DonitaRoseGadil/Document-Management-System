<?php
    if(isset($_POST['save'])){
        include "connect.php";
        error_reporting(0);
        session_start();

        $no_regSession = $_POST['no_regSession'];
        $date = $_POST['date'];
        $genAttachment = $_POST['genAttachment'];

        // Loop through dynamic cards
        if (!empty($_POST['resNo'])) {
            foreach ($_POST['resNo'] as $key => $resNo) {
                $title = $_POST['title'][$key];
                $type = $_POST['type'][$key];
                $status = $_POST['status'][$key];
                $attachment = $_POST['attachment'][$key]; 

                $sql =  "INSERT INTO `minutes` (`no_regSession`, `date`, `genAttachment`, `resNo`, `title`, `type`, `status`, `attachment`) 
                VALUES ('$no_regSession', '$date', '$genAttachment', '$resNo', '$title', '$type', '$status', '$attachment')";
        
                $query = mysqli_query($conn, $sql);

            }
        }       

        if($query) {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Resolution Created',
                            text: 'The minutes has been successfully Created.',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'files-meetingminutes.php';
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
                            text: 'There was an error creating the resolution.',
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

<head>
    <style>
        .card {
            margin-bottom: 15px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>


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
                                <h4 class="card-title text-center" style="color: #098209; ">ADD MEETING MINUTES</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color: #000000">No. of Regular Session</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Please type here..." id="no_regSession" name="no_regSession">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color:#000000">Date:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" placeholder="Please type here..." id="date" name="date">
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="background-color: #098209;"> <i class="fa fa-paperclip"></i></span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="genAttachment[]" name="genAttachment[]" multiple onchange="updateFileName()">
                                                <label class="custom-file-label" for="genAttachment">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
                                            <h5 class="text-primary">AGENDA ITEM</h5>
                                            <button type="button" class="btn btn-primary" id="add-card-btn" value="Save Data" style="background-color: #098209; border: none; width: 100px; color: #FFFFFF;"><i class="fa fa-plus"></i>  Form</button>
                                        </div>
                                        <div id="dynamic-form-container">
                                            <!-- Dynamic cards will be appended here -->
                                        </div>
                                        <div class="form-group row d-flex justify-content-center mt-5">
                                            <button type="submit" class="btn btn-primary" id="save_btn" name="save" value="Save Data" style="background-color: #098209; border: none; width: 100px; color: #FFFFFF;">Save</button>
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

    <script>
        
        document.getElementById("add-card-btn").addEventListener("click", function() {
            addDynamicCard();
        });

        function addDynamicCard() {
            const container = document.getElementById("dynamic-form-container");

            const card = document.createElement("div");
            card.classList.add("card", "p-3");
            
            card.innerHTML = `
                <div class="card-body mt-3">
                    <div class="basic-form">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="color: #000000">Resolution No.:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="resNo[]" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="color: #000000">Title:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="title[]" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-3 col-form-label" style="color: #000000">Type:</label>
                            <div class="col-sm-9">
                                <select id="type" name="type[]" class="form-control">
                                    <option value="" selected>Choose...</option>
                                    <option value="Draft">Draft</option>
                                    <option value="Information">Information</option>
                                    <option value="Referred to Committee">Referred to Committee</option>
                                    <option value="Approved">Approved</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-3 col-form-label" style="color: #000000">Status:</label>
                            <div class="col-sm-9">
                                <select id="status" name="status[]" class="form-control">
                                    <option value="" selected>Choose...</option>
                                    <option value="Draft">Draft</option>
                                    <option value="Information">Information</option>
                                    <option value="Referred to Committee">Referred to Committee</option>
                                    <option value="Approved">Approved</option>
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
                            <button type="button" class="btn btn-danger delete-btn ml-2 flex"><i class='fa fa-trash' aria-hidden='true'> Delete</i></button>
                        </div>
                    </div>
                </div>
            `;

            container.appendChild(card);

            card.querySelector(".delete-btn").addEventListener("click", function () {
                container.removeChild(card);
            });
        }

    </script>
    
</body>

</html>