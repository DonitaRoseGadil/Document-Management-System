<!DOCTYPE html>
<html lang="en">

    <?php include('header.php'); ?>

<body>

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php include('sidebar.php'); ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body" style="background-color: #f1f9f1">
            <!-- row -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center p-3 mt-4">
                                <h1 class="card-title flex-grow-1 fs-4 fw-bold text-dark text-center" style="color: #000000">LIST OF ACCOUNTS</h1>
                                <!-- Button trigger modal -->
                                <div class="button-container d-flex justify-content-end">
                                    <a href="#">
                                        <button type="button" class="btn btn-primary" style="background-color: #098209; color:#FFFFFF; border: none;" data-toggle="modal" data-target="#addAccountModal"><i class="fa fa-plus"></i>&nbsp;Add New Account</button>
                                    </a>  
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px; width: 100%;">
                                        <colgroup>
                                            <col style="width: 40%;">
                                            <col style="width: 20%;">
                                            <col style="width: 15%;">
                                            <col style="width: 15%;">
                                        </colgroup>
                                        <thead class="text-center" style="background-color: #098209; color: #FFFFFF;">
                                            <tr>
                                                <th style="color: #FFFFFF;">Username</th>
                                                <th style="color: #FFFFFF;">Role</th>
                                                <th style="color: #FFFFFF;">Account Status</th>
                                                <th style="color: #FFFFFF;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-left" style="color: #000000;" >
                                            <?php
                                                $sql = "SELECT email, role, account_status FROM accounts";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->execute();
                                                $result = $stmt->get_result();

                                                if (!$result) {
                                                    die("SQL Error: " . $conn->error);
                                                }

                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <tr>
                                                        <td style="pointer-events: none; border-bottom: 1px solid #098209; border-left: 1px solid #098209;"><?php echo $row["email"] ?></td>
                                                        <td style="pointer-events: none; border-bottom: 1px solid #098209;  text-align: center;"><?php echo $row["role"]?></td>
                                                        <td style="pointer-events: none; border-bottom: 1px solid #098209;" class="text-center fs-4">
                                                            <?php 
                                                                switch ($row['account_status']) {
                                                                    case 'active':
                                                                        echo '<span class="badge badge-success">Active</span>';
                                                                        break;
                                                                    case 'inactive':
                                                                        echo '<span class="badge badge-danger">Inactive</span>';
                                                                        break;
                                                                    default:
                                                                        echo $row['account_status']; // fallback if action is not recognized
                                                                }
                                                            ?>
                                                        </td>
                                                        <td style="border-bottom: 1px solid #098209; border-right: 1px solid #098209; text-align: center; vertical-align: middle;">
                                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                                <!-- Button trigger modal -->
                                                                <a class="btn btn-success btn-sm d-flex align-items-center justify-content-center p-2 ml-1 mr-1" data-toggle="modal" data-target="#editAccountModal">
                                                                    <i class="fa fa-edit" aria-hidden="true" style="color: #FFFFFF;"></i>
                                                                </a>
                                                                <a class="btn btn-danger btn-sm d-flex align-items-center justify-content-center p-2">
                                                                    <i class="fa fa-trash" aria-hidden="true" style="color: #FFFFFF"></i>
                                                                </a>
                                                            </div>
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
                <!--**********************************
                    MODALS
                ***********************************-->
                <!-- Add Modal -->  
                <div class="modal fade" id="addAccountModal">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content" style="color: #000000">
                            <div class="modal-header">
                                <h5 class="modal-title">ADD ACOUNT</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="basic-form">
                                    <form>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Username</label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" placeholder="Please type here...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Password</label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" placeholder="Please type here...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Confirm Password</label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" placeholder="Please type here...">
                                            </div>
                                        </div>
                                        <fieldset class="form-group">
                                            <div class="row">
                                                <label class="col-form-label col-sm-4 pt-0">Role</label>
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="optradio"> Admin </label>
                                                        <label class="radio-inline" >
                                                        <label class="radio-inline" >
                                                            <input type="radio" name="optradio" class="ml-4"> User </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" style="background-color: #098209; color:#FFFFFF; border: none;">Add Account</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Edit Modal -->
                <div class="modal fade" id="editAccountModal">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content" style="color: #000000">
                            <div class="modal-header">
                                <h5 class="modal-title">EDIT ACCOUNT</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="basic-form">
                                    <form>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Username</label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" style="background-color: #098209; color:#FFFFFF; border: none;" >Save Changes</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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


</body>

</html>