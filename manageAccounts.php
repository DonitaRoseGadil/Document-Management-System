<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password']; // Capture the confirm password
        $role = $_POST['role'];
        $status = 'active'; // default account status

        // Check if passwords match
        if ($password !== $confirm_password) {
            // Passwords do not match, show SweetAlert and prevent further processing
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Passwords do not match!',
                        confirmButtonColor: '#3085d6'
                    }).then(function() {
                        window.location.href = 'add_account_form_page.php'; // Redirect back to the form
                    });
                </script>";
            exit();
        }

        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert into database
        $sql = "INSERT INTO accounts (email, password, role, account_status) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $email, $hashed_password, $role, $status);

        if ($stmt->execute()) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Account added successfully!',
                        confirmButtonColor: '#098209'
                    }).then(function() {
                        window.location.href = 'add_account_form_page.php'; // Redirect after success
                    });
                </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong! Please try again.',
                        confirmButtonColor: '#3085d6'
                    });
                </script>";
        }

        $stmt->close();
        $conn->close();
    }
?>


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
                                <h5 class="modal-title" style="color:#000000">ADD ACOUNT</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="basic-form">
                                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Username</label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" name="email" placeholder="Please type here..." required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Password</label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" name="password" placeholder="Please type here..." required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Confirm Password</label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" name="confirm_password" placeholder="Please type here..." required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <label class="col-form-label col-sm-4 pt-0">Role</label>
                                            <div class="col-sm-8 d-flex align-items-center">
                                                <label class="mr-3 mb-0">
                                                    <input type="radio" name="role" value="admin" required> Admin
                                                </label>
                                                <label class="mb-0">
                                                    <input type="radio" name="role" value="user" class="ml-2"> User
                                                </label>
                                            </div>
                                        </div>
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
                                <h5 class="modal-title" style="color:#000000">EDIT ACCOUNT</h5>
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
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Account Status</label>
                                            <div class="col-sm-8">
                                                <input type="checkbox" checked data-toggle="toggle" data-on="Deactivate" data-off="Activate" data-onstyle="success" data-offstyle="danger" data-size="sm" data-width="30%" style="border-radius: 50px; text-align: center;">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <label class="col-form-label col-sm-4 pt-0">Role</label>
                                            <div class="col-sm-8 d-flex align-items-center">
                                                <label class="mr-3 mb-0">
                                                    <input type="radio" name="optradio" required> Admin
                                                </label>
                                                <label class="mb-0">
                                                    <input type="radio" name="optradio" class="ml-2"> User
                                                </label>
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

    <!-- Toggle -->
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>


</body>

</html>