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
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <!-- <h4 style="color: #098209">Hi, Welcome!</h4> -->
                            <h4 style="color: #098209" class="mb-2">Document Management System</h4>
                            <p style="color: #098209" class="mb-0">Sangguniang Bayan Office</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                <!-- Minutes Chart -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Minutes</h5>
                            <canvas id="minutesChart"></canvas>
                        </div>
                    </div>
                </div>

                 <!-- Ordinance Chart -->
                 <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ordinance</h5>
                            <canvas id="ordinanceChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Resolution Chart -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Resolution</h5>
                            <canvas id="resolutionChart"></canvas>
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

    <script>
    window.onload = function() {
        console.log(document.getElementById('minutesChart')); // Debugging check

        const createChart = (id, label, data) => {
            let ctx = document.getElementById(id);
            if (!ctx) return; // Prevents error if element is missing
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May'],
                    datasets: [{
                        label: label,
                        data: data,
                        backgroundColor: 'rgba(9, 130, 9, 0.5)',
                        borderColor: 'rgba(9, 130, 9, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: { y: { beginAtZero: true } }
                }
            });
        };

        createChart('minutesChart', 'Minutes', [12, 19, 3, 5, 2]);
        createChart('ordinanceChart', 'Ordinance', [7, 11, 5, 8, 4]);
        createChart('resolutionChart', 'Resolution', [10, 15, 7, 3, 6]);
    };
</script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

    <script src="./vendor/chartist/js/chartist.min.js"></script>

    <script src="./vendor/moment/moment.min.js"></script>
    <script src="./vendor/pg-calendar/js/pignose.calendar.min.js"></script>


    <script src="./js/dashboard/dashboard-2.js"></script>
    <!-- Circle progress -->

</body>

</html>