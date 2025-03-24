<!DOCTYPE html>
<html lang="en">

<?php 
    include "header.php"; 
    include "connect.php";

?>

<body>

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php include "sidebar.php"; ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body" style="background-color: #f1f9f1">
            <div class="container-fluid" >
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">HISTORY</h4>
                            </div>
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <div class="custom-tab-1">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#resolution">Resolution</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#ordinance">Ordinance</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#minutes">Order of Business</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <!--Resolution-->
                                        <div class="tab-pane fade show active" id="resolution" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-responsive-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>TITLE</th>
                                                                <th>ACTION</th>
                                                                <th>TIMESTAMP</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                                include "connect.php";
                                                                $sql = "SELECT title, action, timestamp FROM history_log WHERE file_type = 'Resolution' ORDER BY timestamp DESC";
                                                                $stmt = $conn->prepare($sql);
                                                                $stmt->execute();
                                                                $result = $stmt->get_result();
                                                                if (!$result) {
                                                                    die("SQL Error: " . $conn->error);
                                                                }

                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $row['title']; ?></td>
                                                                        <td><?php echo $row['action']; ?></td>
                                                                        <td><?php echo $row['timestamp']; ?></td>
                                                                    </tr>   
                                                                    <?php
                                                                }
                                                            ?>
                                                            <tr>
                                                                <th>1</th>
                                                                <td>Kolor Tea Shirt For Man</td>
                                                                <td>January 22</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>               
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="ordinance">
                                            <div class="pt-4">
                                            <div class="table-responsive">
                                                    <table class="table table-bordered table-responsive-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>TITLE</th>
                                                                <th>ACTION</th>
                                                                <th>TIMESTAMP</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                                include "connect.php";
                                                                $sql = "SELECT title, action, timestamp FROM history_log WHERE file_type = 'Ordinance' ORDER BY timestamp DESC";
                                                                $stmt = $conn->prepare($sql);
                                                                $stmt->execute();
                                                                $result = $stmt->get_result();
                                                                if (!$result) {
                                                                    die("SQL Error: " . $conn->error);
                                                                }

                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $row['title']; ?></td>
                                                                        <td><?php echo $row['action']; ?></td>
                                                                        <td><?php echo $row['timestamp']; ?></td>
                                                                    </tr>   
                                                                    <?php
                                                                }
                                                            ?>
                                                            <tr>
                                                                <th>1</th>
                                                                <td>Kolor Tea Shirt For Man</td>
                                                                <td>January 22</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="minutes">
                                            <div class="pt-4">
                                                <h5>ORDER OF BUSINESS</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-responsive-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>TITLE</th>
                                                                <th>ACTION</th>
                                                                <th>STATUS</th>
                                                                <th>TIMESTAMP</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                                include "connect.php";
                                                                $sql = "SELECT title, action, timestamp FROM history_log WHERE file_type = 'Minutes' ORDER BY timestamp DESC";
                                                                $stmt = $conn->prepare($sql);
                                                                $stmt->execute();
                                                                $result = $stmt->get_result();
                                                                if (!$result) {
                                                                    die("SQL Error: " . $conn->error);
                                                                }

                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $row['title']; ?></td>
                                                                        <td><?php echo $row['action']; ?></td>
                                                                        <td><?php echo $row['timestamp']; ?></td>
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