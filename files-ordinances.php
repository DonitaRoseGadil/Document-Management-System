<?php 
    error_reporting(E_ALL); // Enable error reporting for development
    ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">

<?php include"header.php" ?>

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
        <div class="content-body" style="background-color: #f1f9f1">
            <div class="container-fluid">
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center p-3 mt-4">
                                <h1 class="card-title flex-grow-1 fs-4 fw-bold text-dark text-center" style="color: #000000">LIST OF ORDINANCES</h1>
                                <div class="button-container d-flex justify-content-end">
                                    <a href="addordinance.php">
                                        <button type="button" class="btn btn-primary" style="background-color: #098209; color:#FFFFFF; border: none;"><i class="fa fa-plus"></i>&nbsp;New Ordinance</button>
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
                                                <th style="color: #FFFFFF;">RES NO./MO NO.</th>
                                                <th style="color: #FFFFFF;">TITLE</th>
                                                <th style="color: #FFFFFF;">DATE ADOPTED</th>
                                                <th style="color: #FFFFFF;">AUTHOR/SPONSOR</th>
                                                <th style="color: #FFFFFF;">REMARKS</th>
                                                <th style="color: #FFFFFF;">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody style="color: #000000;">
                                            <?php
                                                include "connect.php";
                                                $sql = "SELECT id, mo_no, title, date_adopted, author_sponsor, remarks FROM ordinance";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->execute();
                                                $result = $stmt->get_result();

                                                if (!$result) {
                                                    die("SQL Error: " . $conn->error);
                                                }

                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <tr>
                                                        <td style="border-bottom: 1px solid #098209; border-left: 1px solid #098209;"><?php echo $row["mo_no"]?></td>
                                                        <td style="border-bottom: 1px solid #098209;"><?php echo $row["title"] ?></td>
                                                        <td style="border-bottom: 1px solid #098209;"><?php echo $row["date_adopted"] ?></td>
                                                        <td style="border-bottom: 1px solid #098209;"><?php echo $row["author_sponsor"] ?></td>
                                                        <td style="border-bottom: 1px solid #098209;" data-toggle="modal" data-target="#dateModal" class="remarks-cell" data-id="<?php echo $row['id']; ?>">
                                                        <?php echo $row["remarks"] ?></td>
                                                        <td style="border-right: 1px solid #098209; border-bottom: 1px solid #098209;" class='text-center d-flex justify-content-center gap-2'>
                                                            <a href="viewordinance.php?id=<?php echo $row["id"] ?>" class='btn btn-primary btn-sm d-flex align-items-center justify-content-center p-2 mx-1'><i class='fa fa-eye' style="color: #FFFFFF;" aria-hidden='true'></i></a>
                                                            <a href="editordinance.php?id=<?php echo $row["id"] ?>" class='btn btn-success btn-sm d-flex align-items-center justify-content-center p-2 mx-1'><i class='fa fa-edit' style="color:#FFFFFF" aria-hidden='true'></i></a>
                                                            <a onclick="confirmDelete(<?php echo $row['id']; ?>)" class='btn btn-danger btn-sm d-flex align-items-center justify-content-center p-2 mx-1'><i class='fa fa-trash' style="color: #FFFFFF;" aria-hidden='true'></i></a>
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
    
    <!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'deleteordinance.php?id=' + id;
                }
            });
        }
    </script>

</body>

</html>