<?php
    include("session.php");
    include("connect.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));

        $query = $conn->prepare("SELECT * FROM accounts WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['email'] = $user['email'];
                $_SESSION['user_id'] = $user['id'];

                // Generate Token
                $token = bin2hex(random_bytes(32));
                $_SESSION['token'] = $token;

                // Save Token in Database
                $updateToken = $conn->prepare("UPDATE accounts SET token=? WHERE id=?");
                $updateToken->bind_param("si", $token, $user['id']);
                $updateToken->execute();

                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Login successfully',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.href = 'dashboard.php';
                            });
                        });
                    </script>";
            } else {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Invalid Login',
                                text: 'Invalid credentials. Please try again.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = 'login.php';
                            });
                        });
                    </script>";
            }
        } else {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Login',
                            text: 'User not found. Please try again.',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = 'login.php';
                        });
                    });
                </script>";
        }
    }
?>


<!DOCTYPE html>
<html lang="en" class="h-100">

<?php include "header.php"; ?>

<body class="h-100" style="background: url('./images/loginBG.png') no-repeat center center fixed; background-size: cover;">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <!--TEXT LEFT-->
                <div class="col-md-3 mr-5">
                    <div class="col-xl-12">
                        <img src="./images/logo.png" alt="Welcome Image" class="img-fluid d-block mx-auto" style="width: 50%; height: 50%;">
                        <h1 class="text-center mt-4" style="color:#000000; font-weight: bold;">WELCOME<h1>
                        <h3 class="text-center mt-2" style="color:#000000;">Sangguniang Bayan Office</h3>
                        <h4 class="text-center mt-2" style="color:#000000;">Document Management System</h4>
                    </div>
                </div>
                <!--TEXT RIGHT-->
                <div class="col-md-3 ml-5">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h1 class="text-center" style="color:#098209">Log in<h1>
                                    <h4 class="text-center mb-4" style="color:#000000">Sign in your account</h4>
                                    <form id="loginForm" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                        <div class="form-group">
                                            <!-- <label ><strong>Email</strong></label> -->
                                            <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                                        </div>
                                        <div class="form-group">
                                            <!-- <label><strong>Password</strong></label> -->
                                            <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <div class="form-check ml-2">
                                                    <input class="form-check-input" type="checkbox" id="basic_checkbox_1">
                                                    <label class="form-check-label" for="basic_checkbox_1">Remember me</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <a href="page-forgot-password.html" style="color:#098209">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block" style="background-color: #098209; border-color:#098209;">Sign me in</button>
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


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>