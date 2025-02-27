<?php

    if(isset($_POST['login'])) {
        session_start();
        include("connect.php");

        if ($stmt = $conn->prepare('SELECT id, password FROM accounts WHERE email = ?')) {
            // Bind parameters (s = string, i = int, b = blob, etc)
            $stmt->bind_param('s', $_POST['email']);
            $stmt->execute();
            // Store the result so we can check if the account exxists in the db.
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $password);
                $stmt->fetch();
                // Account exists, now we verify the password.

                if ($_POST['password'] === $password) {
                    // Verification success! Uset has logged-in!
                    session_regenerate_id();
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['name'] = $_POST['email'];
                    $_SESSION['id'] = $id;
                    echo 'Welcome back, ' . htmlspecialchars($_SESSION['name'], ENT_QUOTES) . '!';
                } else {
                    echo "<script>
                    Swal.fire({
                        title: 'Wrong Credentials',
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    });
                    </script>";
                }
            } else {
                echo "<script>
                    Swal.fire({
                        title: 'Wrong Credentials',
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    });
                </script>";
            }

            $stmt->close();
        }
    }

    

    /* include("connect.php");
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = mysqli_real_escape_string($check, $_POST['email']);
        $password = mysqli_real_escape_string($check, $_POST['password']);

        $data = mysqli_query($check, "SELECT * FROM admin WHERE email='$email' AND password='$password'");

        if (mysqli_num_rows($data) == 1) {
            $_SESSION['message'] = "success";
            header("Location: login.php"); // Redirect to prevent form resubmission
            exit();
        } else {
            $_SESSION['message'] = "error";
            header("Location: login.php");
            exit();
        }
    }*/
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
                                    <form id="loginForm" action="" method="post">
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
                                            <button type="submit" class="btn btn-primary btn-block" name="login" style="background-color: #098209; border-color:#098209;">Sign me in</button>
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

    <?php
        /*
        if (isset($_SESSION['message'])) {
            if ($_SESSION['message'] == "success") {
                echo "<script>
                    Swal.fire({
                        title: 'Login Successful!',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = 'dashboard.php';
                    });
                </script>";
            } elseif ($_SESSION['message'] == "error") {
                echo "<script>
                    Swal.fire({
                        title: 'Wrong Credentials',
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    });
                </script>";
            }
            unset($_SESSION['message']); // Clear session message after showing alert
        } */
    ?>

</body>

</html>