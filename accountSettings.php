<?php
session_start();
include('connect.php'); // Include your database connection

$message = ""; // Variable for SweetAlert messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['current_password']) && isset($_POST['new_password'])) {
        $email = $_SESSION['email']; // Assuming email is stored in session
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];

        // Fetch current password from database
        $sql = "SELECT password FROM accounts WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($db_password);
        $stmt->fetch();
        $stmt->close();

        // Verify current password
        if (password_verify($current_password, $db_password)) {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            // Update password in the database
            $update_sql = "UPDATE accounts SET password = ? WHERE email = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ss", $hashed_password, $email);

            if ($update_stmt->execute()) {
                $message = "success"; // Password changed successfully
            } else {
                $message = "error"; // Database error
            }
            $update_stmt->close();
        } else {
            $message = "incorrect"; // Wrong current password
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('header.php'); ?>

<body>

    <div id="main-wrapper">
        <?php include 'sidebar.php'; ?>

        <div class="content-body" style="background-color: #f1f9f1">
            <div class="container-fluid">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-md-6 mt-3">
                        <div class="authincation-content">
                            <div class="row no-gutters">
                                <div class="col-xl-12">
                                    <div class="auth-form">
                                        <h4 class="text-center mb-4" style="color: #000000;">Set New Password</h4>
                                        <form method="POST" onsubmit="return validatePasswords()">
                                            <div class="form-group" style="position: relative;">
                                                <label style="color:#000000;">Enter Current Password</label>
                                                <input type="password" class="form-control" name="current_password" id="current_password" 
                                                    style="padding-right: 35px; width: 100%;" required>
                                                <i class="fa fa-eye-slash" id="toggleEyeCurrent" onclick="togglePassword('current_password', 'toggleEyeCurrent')" 
                                                    style="position: absolute; right: 10px; top: 70%; transform: translateY(-50%); font-size: 18px; cursor: pointer; color: #098209;"></i>
                                            </div>

                                            <div class="form-group" style="position: relative;">
                                                    <label style="color:#000000">Enter New Password</label>
                                                    <input type="password" class="form-control" name="new_password" id="new_password" 
                                                        style="padding-right: 35px; width: 100%;" required>
                                                    <i class="fa fa-eye-slash" id="toggleEyeNew" onclick="togglePassword('new_password', 'toggleEyeNew')" 
                                                        style="position: absolute; right: 10px; top: 70%; transform: translateY(-50%); font-size: 18px; cursor: pointer; color: #098209;"></i>
                                                </div>

                                                <div class="form-group" style="position: relative;">
                                                    <label style="color:#000000">Confirm New Password</label>
                                                    <input type="password" class="form-control" id="confirm_password" 
                                                        style="padding-right: 35px; width: 100%;" required>
                                                    <i class="fa fa-eye-slash" id="toggleEyeConfirm" onclick="togglePassword('confirm_password', 'toggleEyeConfirm')" 
                                                        style="position: absolute; right: 10px; top: 70%; transform: translateY(-50%); font-size: 18px; cursor: pointer; color: #098209;"></i>
                                                </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-block" style="background-color: #098209; border: none; color: #FFFFFF;">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- SweetAlert2 Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function validatePasswords() {
            var newPassword = document.getElementById("new_password").value;
            var confirmPassword = document.getElementById("confirm_password").value;

            if (newPassword !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'New passwords do not match!',
                    confirmButtonColor: '#d33'
                });
                return false;
            }
            return true;
        }

        <?php if (!empty($message)): ?> // Ensures alert shows only when needed
            <?php if ($message == "success") : ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Password has been changed successfully.',
                    confirmButtonColor: '#28a745'
                });
            <?php elseif ($message == "incorrect") : ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Current password is incorrect!',
                    confirmButtonColor: '#d33'
                });
            <?php elseif ($message == "error") : ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Please try again!',
                    confirmButtonColor: '#d33'
                });
            <?php endif; ?>
        <?php endif; ?>
    </script>

    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

    <script>
        function togglePassword(inputId, eyeId) {
            var passwordInput = document.getElementById(inputId);
            var eyeIcon = document.getElementById(eyeId);

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            }
        }
    </script>


</body>

</html>