<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Document Management System</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/logo.png">
    <link href="./css/style.css" rel="stylesheet">

</head>

<body class="h-100" style="background: url('./images/loginBG.png') no-repeat center center fixed; background-size: cover;">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <!--TEXT LEFT-->
                <div class="col-md-3 mr-5">
                    <div class="col-xl-12">
                        <img src="./images/logo.png" alt="Welcome Image" class="img-fluid d-block mx-auto" style="width: 50%; height: 50%;">
                        <h1 class="text-center mt-4" style="color:#000000; font-weight: bold;">WELCOME<h1>
                        <h3 class="text-center mt-2" style="color:#000000;">Document Management System</h3>
                        <h5 class="text-center mt-4" style="color:#000000;">Log in to Continue</h5>
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
                                    <form action="dashboard.php">
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="email" class="form-control" value="hello@example.com">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" class="form-control" value="Password">
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

</body>

</html>