<!DOCTYPE html>
<html lang="en">

<?php 
include "header.php"; 
include "connect.php"; 


date_default_timezone_set('Asia/Manila');

$lastUpdatedText = "No updates yet";


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $resolution_id = intval($_GET['id']);

    if ($resolution_id > 0) {
        // Fetch the last updated timestamp for the specific file
        $sql = "SELECT timestamp FROM history_log WHERE file_id = ? ORDER BY timestamp DESC LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $resolution_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lastUpdated = strtotime($row["timestamp"]); // Convert to Unix timestamp
            $currentDate = date("Y-m-d"); // Get today's date
            $updatedDate = date("Y-m-d", $lastUpdated); // Get last updated date

            if ($currentDate === $updatedDate) {
                // If updated today, show "Today at [time]"
                $lastUpdatedText = "Last updated today at " . date("g:i A", $lastUpdated);
            } else {
                // Show full date and time if not today
                $lastUpdatedText = "Last updated on " . date("F j, Y \\a\\t g:i A", $lastUpdated);
            }
        }

        $stmt->close();
    }
}

$conn->close();
?>

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
        <div class="content-body" style="background-color: #f1f9f1">
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
                                                <input type="text" class="form-control" value="<?php echo $row['mo_no']?>" id="moNo" name="moNo" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color:#000000">Title:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="<?php echo $row['title']?>" id="title" name="title" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color:#000000">Date Adopted:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" value="<?php echo $row['date_adopted']?>" id="dateAdopted" name="dateAdopted" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="color: #000000">Author / Sponsor:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="<?php echo $row['author_sponsor']?>" id="authorSponsor" name="authorSponsor" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="status" class="col-sm-3 col-form-label" style="color: #000000">Status:</label>
                                            <div class="col-sm-9">
                                                <select id="remarks" value="<?php echo $row['remarks']?>" name="status" class="form-control" disabled>
                                                    <option value="" selected>Choose...</option>
                                                    <option value="Forwarded to LCE" <?php if ($row['remarks'] == "Forwarded to LCE") echo "selected"; ?>>Forwarded to LCE</option>
                                                    <option value="Signed by LCE" <?php if ($row['remarks'] == "Signed by LCE") echo "selected"; ?>>Signed by LCE</option>
                                                    <option value="SB Approval" <?php if ($row['remarks'] == "SB Approval") echo "selected"; ?>>SB Approval</option>
                                                    <option value="Disapprove" <?php if ($row['remarks'] == "Disapprove") echo "selected"; ?>>Disapprove</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="dateFields">
                                            <div class="form-group row" id="forwardedDateField">
                                                <label class="col-sm-3 col-form-label" style="color:#000000">Date Forwarded to LCE:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" value="<?php echo $row['date_fwd']?>" id="dateForwarded" name="dateForwarded" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group row" id="signedDateField">
                                                <label class="col-sm-3 col-form-label" style="color:#000000">Date Signed by LCE:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" value="<?php echo $row['date_signed']?>" id="dateSigned" name="dateSigned" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group row" id="sbApprovalDateField">
                                                <label class="col-sm-3 col-form-label" style="color:#000000">SB Approval:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" value="<?php echo $row['sp_approval']?>" id="spApproval" name="spApproval" disabled>
                                                </div>
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

                            <!-- View History Button -->
                            <div class="card-footer d-sm-flex justify-content-between">
                                <div class="card-footer-link mb-4 mb-sm-0">
                                    <p class="card-text text-dark d-inline"><?php echo $lastUpdatedText; ?></p>
                                </div>
                                <button type="button" class="btn text-white" style="background-color: #098209;" data-toggle="modal" data-target="#historyModal">View History</button>
                            </div>

                            <!-- Modal for Viewing History -->
                            <div class="modal fade" id="historyModal" tabindex="-1" aria-labelledby="historyModalLabel" aria-hidden="true d-flex justify-content center">
                                <div class="modal-dialog modal-l modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="historyModalLabel">File History</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body d-flex justify-content-center">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="color: #000000; font-weight:bold; text-align: center;">Title</th>
                                                        <th style="color: #000000; font-weight:bold; text-align: center;">Action</th>
                                                        <th style="color: #000000; font-weight:bold; text-align: center;">Timestamp</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="historyTableBody">
                                                    <tr><td colspan="3">Loading history...</td></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- <div class="modal-footer">
                                            <button type="button" class="btn btn-danger text-white" data-dismiss="modal">Close</button>
                                        </div> -->
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
    <script>
        function toggleViewDateFields() {
            var status = document.getElementById("remarks").value;

            // Hide all date fields initially
            document.getElementById("forwardedDateField").style.display = "none";
            document.getElementById("signedDateField").style.display = "none";
            document.getElementById("sbApprovalDateField").style.display = "none";

            // Show fields based on status
            if (status === "Forwarded to LCE") {
                document.getElementById("forwardedDateField").style.display = "flex";
            } else if (status === "Signed by LCE") {
                document.getElementById("forwardedDateField").style.display = "flex";
                document.getElementById("signedDateField").style.display = "flex";
            } else if (status === "SB Approval") {
                document.getElementById("forwardedDateField").style.display = "flex";
                document.getElementById("signedDateField").style.display = "flex";
                document.getElementById("sbApprovalDateField").style.display = "flex";
            }
        }

    window.onload = toggleViewDateFields;
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#historyModal').on('show.bs.modal', function() {
                let resolutionId = "<?php echo $resolution_id; ?>";

                if (!resolutionId) {
                    $('#historyTableBody').html("<tr><td colspan='3'>No history available.</td></tr>");
                    return;
                }

                fetch(`fetch_history.php?id=${resolutionId}`)
                    .then(response => response.json())
                    .then(data => {
                        let historyHtml = "";
                        if (data.length > 0) {
                            data.forEach(log => {
                                historyHtml += `<tr>
                                                    <td style="color: #000000;">${log.title}</td>
                                                    <td style="color: #000000;">${log.action}</td>
                                                    <td style="color: #000000;">${log.timestamp}</td>
                                                </tr>`;
                            });
                        } else {
                            historyHtml = "<tr><td colspan='3'>No history found.</td></tr>";
                        }
                        document.getElementById("historyTableBody").innerHTML = historyHtml;
                    })
                    .catch(error => {
                        console.error("Error fetching history:", error);
                        document.getElementById("historyTableBody").innerHTML = "<tr><td colspan='3'>Error loading history.</td></tr>";
                    });
            });
        });
        </script>
        
    
</body>

</html>