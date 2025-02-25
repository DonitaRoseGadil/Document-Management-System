<!DOCTYPE html>
<html lang="en">

<?php include "header.php"; ?>

<body>
    <!-- Main Wrapper Start -->
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

        <!-- Content Body Start -->
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
                    <!-- Stats Section -->
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

                <!-- Activities and Shortcuts Section -->
                <div class="row">
                    <!-- Recent Activities Section -->
                    <div class="col-lg-6">
                        <h4 class="mt-4 ml-4" style="color: #098209;">RECENT ACTIVITIES</h4>
                        <div class="row flex-column ml-2" id="recentActivities" style="gap: 2px;">
                            <p id="lastUpdated" style="color: gray; margin-left: 10px;"></p>
                        </div>
                    </div>


                    <!-- Shortcuts Section -->
                    <div class="col-lg-6">
                        <h4 class="mt-4 ml-4" style="color: #098209;">SHORTCUTS</h4>
                        <div class="row flex-column ml-2" style="gap: 2px;">
                            <div class="col-lg-12">
                                <div class="card p-2 d-flex align-items-center"
                                    style="margin-bottom: 10px; border-radius: 6px; border: 1px solid #098209; 
                                            display: flex; flex-direction: row; justify-content: space-between;">
                                    <span style="color: black; font-weight: bold;">Add new file resolution</span>
                                    <button class="btn btn-success btn-sm" onclick="window.location.href='addresolution.php';">+</button>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="card p-2 d-flex align-items-center"
                                    style="margin-bottom: 10px; border-radius: 6px; border: 1px solid #098209; 
                                            display: flex; flex-direction: row; justify-content: space-between;">
                                    <span style="color: black; font-weight: bold;">Add new file ordinances</span>
                                    <button class="btn btn-success btn-sm" onclick="window.location.href='addordinance.php';">+</button>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="card p-2 d-flex align-items-center"
                                    style="margin-bottom: 10px; border-radius: 6px; border: 1px solid #098209; 
                                            display: flex; flex-direction: row; justify-content: space-between;">
                                    <span style="color: black; font-weight: bold;">Add new meeting minutes</span>
                                    <button class="btn btn-success btn-sm" onclick="window.location.href='addmeetingminutes.php';">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="copyright"></div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        fetchRecentActivities();
    });

    function fetchRecentActivities() {
    fetch("recentactivities.php?timestamp=" + new Date().getTime())
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error! Status: " + response.status);
            }
            return response.json();
        })
        .then(data => {
            let activitiesContainer = document.getElementById("recentActivities");
            activitiesContainer.innerHTML = ""; 

            if (data.activities.length > 0) {
                data.activities.forEach(activity => {
                    let activityHTML = `
                        <div class="col-lg-12">
                            <div class="card p-2" style="margin-bottom: 10px; border-radius: 6px; border: 1px solid #098209;">
                                <div style="color: black;"><strong>${activity.file_type}: ${activity.title}</strong></div>
                                <div style="color: gray; font-size: 0.8rem;">${activity.action} on ${activity.timestamp}</div>
                            </div>
                        </div>
                    `;
                    activitiesContainer.insertAdjacentHTML("beforeend", activityHTML);
                });
            } else {
                activitiesContainer.innerHTML = '<p style="color: gray; margin-left: 10px;">No recent activities.</p>';
            }
        })
        .catch(error => console.error("Error fetching activities:", error));
}

</script>


</body>
</html>
