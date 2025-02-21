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

        <!-- Database Connection -->
        <?php
        // Database connection
        $conn = new mysqli("localhost", "root", "", "lgu_dms");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch counts from tables
        $resolution_count = $conn->query("SELECT COUNT(*) as count FROM resolution")->fetch_assoc()['count'];
        $ordinance_count = $conn->query("SELECT COUNT(*) as count FROM ordinance")->fetch_assoc()['count'];
        $minutes_count = $conn->query("SELECT COUNT(*) as count FROM minutes")->fetch_assoc()['count'];
        ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4 style="color: #098209" class="mb-0">Document Management System</h4>
                            <p style="color: #098209" class="mb-0">Sangguniang Bayan Office</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block">
                                    <i class="ti-file text-success border-success"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text">Resolution</div>
                                    <div class="stat-digit"><?php echo $resolution_count; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block">
                                    <i class="ti-folder text-primary border-primary"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text">Ordinances</div>
                                    <div class="stat-digit"><?php echo $ordinance_count; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block">
                                    <i class="ti-agenda text-danger border-danger"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text">Meeting Minutes</div>
                                    <div class="stat-digit"><?php echo $minutes_count; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="mt-4 ml-4" style="color: #098209;">RECENT ACTIVITIES</h4>
                <div class="row flex-column ml-2" style="gap: 2px;">
                    <div class="col-lg-6">
                        <div class="card p-2" style="margin-bottom: 10px; border-radius: 6px; border: 1px solid #098209;">
                            <div style="color: black;"><strong>Resolution No. 1 Lorem Ipsum</strong></div>
                            <div style="color: gray; font-size: 0.7rem;">February 20, 2025 3:00 P.M.</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card p-2" style="margin-bottom: 10px; border-radius: 6px; border: 1px solid #098209;">
                            <div style="color: black;"><strong>Resolution No. 2 Lorem Ipsum</strong></div>
                            <div style="color: gray; font-size: 0.7rem;">February 20, 2025 3:00 P.M.</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card p-2" style="margin-bottom: 10px; border-radius: 6px; border: 1px solid #098209;">
                            <div style="color: black;"><strong>Resolution No. 3 Lorem Ipsum</strong></div>
                            <div style="color: gray; font-size: 0.7rem;">February 20, 2025 3:00 P.M.</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card p-2" style="margin-bottom: 10px; border-radius: 6px; border: 1px solid #098209;">
                            <div style="color: black;"><strong>Resolution No. 4 Lorem Ipsum</strong></div>
                            <div style="color: gray; font-size: 0.7rem;">February 20, 2025 3:00 P.M.</div>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="mt-4 ml-4" style="color: #098209;">SHORTCUTS</h4>
                <div class="row flex-column ml-2" style="gap: 2px;">
                    <div class="col-lg-6">
                        <div class="card p-2" style="margin-bottom: 10px; border-radius: 6px; border: 1px solid #098209;">
                            <div style="color: black;"><strong>Resolution No. 1 Lorem Ipsum</strong></div>
                            <div style="color: gray; font-size: 0.7rem;">February 20, 2025 3:00 P.M.</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card p-2" style="margin-bottom: 10px; border-radius: 6px; border: 1px solid #098209;">
                            <div style="color: black;"><strong>Resolution No. 2 Lorem Ipsum</strong></div>
                            <div style="color: gray; font-size: 0.7rem;">February 20, 2025 3:00 P.M.</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card p-2" style="margin-bottom: 10px; border-radius: 6px; border: 1px solid #098209;">
                            <div style="color: black;"><strong>Resolution No. 3 Lorem Ipsum</strong></div>
                            <div style="color: gray; font-size: 0.7rem;">February 20, 2025 3:00 P.M.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>

        
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright"></div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
</body>

</html>
