<!DOCTYPE html>
<html lang="en">

<?php include "header.php"; ?>

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
        <div class="content-body" style="color: #098209;">
            <div class="container-fluid">
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center p-3 mt-4">
                                <h1 class="card-title flex-grow-1 fs-4 fw-bold text-dark text-center" style="color: #000000">MINUTES OF THE MEETING</h1>
                                <div class="button-container d-flex justify-content-end">
                                    <a href="addmeetingminutes.php">
                                        <button type="button" class="btn btn-primary" style="background-color: #098209; color:#FFFFFF; border: none;"><i class="fa fa-plus"></i>&nbsp;Add New Subject</button>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead class="text-left" style="background-color: #098209; color: #FFFFFF;">
                                            <tr>
                                                <th style="color: #FFFFFF;">NUMBER OF REGULAR SESSION</th>
                                                <th style="color: #FFFFFF;">DATE</th>
                                                <th style="color: #FFFFFF;">ATTACHMENT</th>

                                            </tr>
                                        </thead>
                                        <tbody class="text-left" style="color: #000000;" >
                                        <tr>
                                            <td>4th Regular Session</td>
                                            <td>January 27, 2025</td>
                                            <td>Green City Initiative</td>
                                        </tr>
                                        <tr>
                                            <td>5th Regular Session</td>
                                            <td>February 3, 2025</td>
                                            <td>Community Cleanup Drive</td>
                                        </tr>
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