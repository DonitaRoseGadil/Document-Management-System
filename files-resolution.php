<?php 
include "header.php"; 
error_reporting(E_ALL); // Enable error reporting for development
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">

<body>

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

    <?php include "navheader.php"; ?>

    <?php include "sidebar.php"; ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center p-3 mt-4">
                                <h1 class="card-title flex-grow-1 fs-4 fw-bold text-dark text-center" style="color: #000000">LIST OF RESOLUTION</h1>
                                <div class="button-container d-flex justify-content-end">
                                    <a href="addresolution.php">
                                        <button type="button" class="btn btn-primary" style="background-color: #098209; color:#FFFFFF; border: none;"><i class="fa fa-plus"></i>&nbsp;Add New Resolution</button>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <colgroup>
                                            <col style="width: 15%;">
                                            <col style="width: 25%;">
                                            <col style="width: 15%;">
                                            <col style="width: 15%;">
                                            <col style="width: 15%;">
                                            <col style="width: 15%;">
                                        </colgroup>
                                        <thead class="text-center" style="background-color: #098209; color: #FFFFFF;">
                                            <tr>
                                                <th style="color: #FFFFFF;">RESO NO./MO NO.</th>
                                                <th style="color: #FFFFFF;">TITLE</th>
                                                <th style="color: #FFFFFF;">AUTHOR/SPONSOR</th>
                                                <th style="color: #FFFFFF;">CO-AUTHOR</th>
                                                <th style="color: #FFFFFF;">REMARKS</th>
                                                <th style="color: #FFFFFF;">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody style="color: #000000; border:#000000;">
                                            <?php
                                                include "connect.php";

                                                $sql = "SELECT id, reso_no, title, author_sponsor, co_author, remarks, d_forward, d_signed, d_approved FROM resolution";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->execute();
                                                $result = $stmt->get_result();

                                                if (!$result) {
                                                    die("SQL Error: " . $conn->error);
                                                }

                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <tr>
                                                        <td style="border-bottom: 1px solid #098209; border-left: 1px solid #098209;"><?php echo $row["reso_no"] ?></td>
                                                        <td style="border-bottom: 1px solid #098209;"><?php echo $row["title"] ?></td>
                                                        <td style="border-bottom: 1px solid #098209;"><?php echo $row["author_sponsor"] ?></td>     
                                                        <td style="border-bottom: 1px solid #098209;"><?php echo $row["co_author"] ?></td>
                                                        <td style="border-bottom: 1px solid #098209;">
                                                            <div class="container">
                                                                <a style="color: #000000" id="popoverData" class="btn" href="#" data-content="Forwarded to LCE: <?php echo $row["d_forward"] ?>" rel="popover" 
                                                                data-placement="bottom" data-trigger="hover"><?php echo $row["remarks"] ?></a>
                                                            </div>
                                                        </td>
                                                        <td style="border-bottom: 1px solid #098209; border-right: 1px solid #098209;" class='text-center d-flex justify-content-center gap-2'>
                                                            <a href="viewresolution.php?id=<?php echo $row["id"] ?>" class='btn btn-primary btn-sm d-flex align-items-center justify-content-center p-2 mx-1'><i class='fa fa-eye' aria-hidden='true' style="color: #FFFFFF;"></i></a>
                                                            <a href="editresolution.php?id=<?php echo $row["id"] ?>" class='btn btn-success btn-sm d-flex align-items-center justify-content-center p-2 mx-1'><i class='fa fa-edit' aria-hidden='true' style="color: #FFFFFF;"></i></a>
                                                            <a onclick="confirmDelete(<?php echo $row['id']; ?>)" class='btn btn-danger btn-sm d-flex align-items-center justify-content-center p-2 mx-1' ><i class='fa fa-trash' aria-hidden='true' style="color: #FFFFFF"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div class="modal fade" id="dateModal">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" style="color: #098209;">REMARKS</h5>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table id="example" class="display" style="min-width: 450px;">
                                                        <thead class="text-center" style="background-color: #098209; color: #FFFFFF;">
                                                            <tr>
                                                                <th class="text-center" data-toggle="tooltip" style="color: #FFFFFF;" >Forwarded to LCE</th>
                                                                <th class="text-center" style="color: #FFFFFF;">Signed by LCE</th>
                                                                <th class="text-center" style="color: #FFFFFF;">SP Approval</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody style="color: #000000;">
                                                            <?php
                                                                include "connect.php";

                                                                $sql = "SELECT d_forward, d_signed, d_approved FROM resolution limit 1";
                                                                $stmt = $conn->prepare($sql);
                                                                $stmt->execute();
                                                                $result = $stmt->get_result();

                                                                if (!$result) {
                                                                    die("SQL Error: " . $conn->error);
                                                                }

                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $row["d_forward"] ?></td>
                                                                        <td><?php echo $row["d_signed"] ?></td>
                                                                        <td><?php echo $row["d_approved"] ?></td>     
                                                                        </td>
                                                                    </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    
    <!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>

    <script>
        $('#popoverData').popover();
        $('#popoverOption').popover({ trigger: "hover" });

        function confirmDelete(id) {
            Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'deleteresolution.php?id=' + id;
                }
            });
        }
        document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".remarks-cell").forEach(function (cell) {
        cell.addEventListener("click", function () {
            // Get data from the clicked row
            var forwardDate = this.getAttribute("data-forward");
            var signedDate = this.getAttribute("data-signed");
            var approvedDate = this.getAttribute("data-approved");

            // Update modal content
            document.getElementById("modalForward").textContent = forwardDate || "N/A";
            document.getElementById("modalSigned").textContent = signedDate || "N/A";
            document.getElementById("modalApproved").textContent = approvedDate || "N/A";
        });
    });
});

    </script>

</body>

</html>