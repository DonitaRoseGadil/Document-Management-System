<!DOCTYPE html>
<html lang="en">

<?php 
include "header.php"; 
error_reporting(E_ALL); // Enable error reporting for development
ini_set('display_errors', 1);
session_start();
?>

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
                                        <thead class="text-center" style="background-color: #098209; color: #FFFFFF;">
                                            <tr>
                                                <th style="color: #FFFFFF;">RESOLUTION NO./ MO NO.</th>
                                                <th style="color: #FFFFFF;">TITLE</th>
                                                <th style="color: #FFFFFF;">DATE ADOPTED</th>
                                                <th style="color: #FFFFFF;">AUTHOR/SPONSOR</th>
                                                <th style="color: #FFFFFF;">REMARKS</th>
                                                <th style="color: #FFFFFF;">DATE APPROVED</th>
                                                <th style="color: #FFFFFF;">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody style="color: #000000;">
                                            <?php
                                            include "connect.php";

                                            $sql = "SELECT reso_no, title, d_adopted, author_sponsor, remarks, d_approved FROM resolution";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            if (!$result) {
                                                die("SQL Error: " . $conn->error);
                                            }

                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>
                                                        <td>{$row['reso_no']}</td>
                                                        <td>{$row['title']}</td>
                                                        <td>{$row['d_adopted']}</td>
                                                        <td>{$row['author_sponsor']}</td>
                                                        <td>{$row['remarks']}</td>
                                                        <td>{$row['d_approved']}</td>
                                                        <td class='text-center'>
                                                            <a href='viewresolution.php?id={$row['reso_no']}' class='btn btn-primary btn-sm'><i class='fa fa-eye' aria-hidden='true'></i></a>
                                                            <a href='editresolution.php?id={$row['reso_no']}' class='btn btn-success btn-sm'><i class='fa fa-edit' aria-hidden='true'></i></a>
                                                            <a href='deleteresolution.php?id={$row['reso_no']}' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></a>
                                                        </td>
                                                    </tr>";
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

</body>

</html>