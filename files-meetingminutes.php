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
        <div class="content-body">
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
                                        <thead class="text-center" style="background-color: #098209; color: #FFFFFF;">
                                            <tr>
                                                <th style="color: #FFFFFF;">RESOLUTION NO./ MO NO.</th>
                                                <th style="color: #FFFFFF;">TITLE</th>
                                                <th style="color: #FFFFFF;">DATE ADOPTED</th>
                                                <th style="color: #FFFFFF;">AUTHOR/SPONSOR</th>
                                                <th style="color: #FFFFFF;">REMARKS</th>
                                                <th style="color: #FFFFFF;">DATE APPROVED</th>
                                            </tr>
                                        </thead>
                                        <tbody style="color: #000000;">
                                        <tr>
                                            <td>MO-001-2025</td>
                                            <td>Green City Initiative</td>
                                            <td>2025-01-15</td>
                                            <td>Councilor Jane Doe</td>
                                            <td>Approved</td>
                                            <td>2025-01-20</td>
                                        </tr>
                                        <tr>
                                            <td>RES-002-2025</td>
                                            <td>Community Cleanup Drive</td>
                                            <td>2025-01-18</td>
                                            <td>Councilor Mark Cruz</td>
                                            <td>Pending</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>MO-003-2025</td>
                                            <td>Tree Planting Program</td>
                                            <td>2025-01-25</td>
                                            <td>Mayor Anna Reyes</td>
                                            <td>Approved</td>
                                            <td>2025-01-30</td>
                                        </tr>
                                        <tr>
                                            <td>RES-004-2025</td>
                                            <td>Digital Literacy for Seniors</td>
                                            <td>2025-02-01</td>
                                            <td>Vice Mayor Lily Gomez</td>
                                            <td>Ongoing Implementation</td>
                                            <td>2025-02-05</td>
                                        </tr>
                                        <tr>
                                            <td>MO-005-2025</td>
                                            <td>Public Wi-Fi Expansion</td>
                                            <td>2025-02-10</td>
                                            <td>Councilor John Smith</td>
                                            <td>Approved</td>
                                            <td>2025-02-15</td>
                                        </tr>
                                        <tr>
                                            <td>RES-006-2025</td>
                                            <td>Flood Control Measures</td>
                                            <td>2025-02-18</td>
                                            <td>Councilor Sarah Tan</td>
                                            <td>Pending Budget Approval</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>MO-007-2025</td>
                                            <td>Support for Local Farmers</td>
                                            <td>2025-02-22</td>
                                            <td>Mayor Paul Reyes</td>
                                            <td>Approved</td>
                                            <td>2025-02-28</td>
                                        </tr>
                                        <tr>
                                            <td>RES-008-2025</td>
                                            <td>Sports Development Fund</td>
                                            <td>2025-03-05</td>
                                            <td>Councilor Emma Torres</td>
                                            <td>Ongoing Review</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>MO-009-2025</td>
                                            <td>Community Health Clinics</td>
                                            <td>2025-03-12</td>
                                            <td>Vice Mayor Lily Gomez</td>
                                            <td>Approved</td>
                                            <td>2025-03-18</td>
                                        </tr>
                                        <tr>
                                            <td>RES-010-2025</td>
                                            <td>Energy Conservation Campaign</td>
                                            <td>2025-03-20</td>
                                            <td>Councilor Jane Doe</td>
                                            <td>Approved</td>
                                            <td>2025-03-25</td>
                                        </tr>
                                        <tr>
                                            <td>MO-011-2025</td>
                                            <td>School Safety Awareness</td>
                                            <td>2025-04-01</td>
                                            <td>Councilor Mark Cruz</td>
                                            <td>Pending</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>RES-012-2025</td>
                                            <td>Promotion of Arts and Culture</td>
                                            <td>2025-04-10</td>
                                            <td>Mayor Anna Reyes</td>
                                            <td>Approved</td>
                                            <td>2025-04-15</td>
                                        </tr>
                                        <tr>
                                            <td>MO-013-2025</td>
                                            <td>Infrastructure Development Plan</td>
                                            <td>2025-04-20</td>
                                            <td>Vice Mayor Lily Gomez</td>
                                            <td>Pending Review</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>RES-014-2025</td>
                                            <td>Waste Management Policy</td>
                                            <td>2025-04-30</td>
                                            <td>Councilor Sarah Tan</td>
                                            <td>Approved</td>
                                            <td>2025-05-05</td>
                                        </tr>
                                        <tr>
                                            <td>MO-015-2025</td>
                                            <td>Disaster Preparedness Program</td>
                                            <td>2025-05-10</td>
                                            <td>Mayor Paul Reyes</td>
                                            <td>Ongoing</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>RES-016-2025</td>
                                            <td>Public Transport Improvement</td>
                                            <td>2025-05-20</td>
                                            <td>Councilor Emma Torres</td>
                                            <td>Approved</td>
                                            <td>2025-05-25</td>
                                        </tr>
                                        <tr>
                                            <td>MO-017-2025</td>
                                            <td>Community Safety Initiative</td>
                                            <td>2025-06-01</td>
                                            <td>Vice Mayor Lily Gomez</td>
                                            <td>Pending</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>RES-018-2025</td>
                                            <td>Traffic Management Solutions</td>
                                            <td>2025-06-15</td>
                                            <td>Councilor John Smith</td>
                                            <td>Ongoing</td>
                                            <td>N/A</td>
                                        </tr>
                                        <tr>
                                            <td>MO-019-2025</td>
                                            <td>Housing for Low-Income Families</td>
                                            <td>2025-06-25</td>
                                            <td>Mayor Anna Reyes</td>
                                            <td>Approved</td>
                                            <td>2025-07-01</td>
                                        </tr>
                                        <tr>
                                            <td>RES-020-2025</td>
                                            <td>Green Energy Solutions</td>
                                            <td>2025-07-10</td>
                                            <td>Councilor Sarah Tan</td>
                                            <td>Pending</td>
                                            <td>N/A</td>
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
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Quixkit</a> 2019</p>
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