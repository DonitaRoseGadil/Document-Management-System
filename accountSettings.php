<!DOCTYPE html>
<html lang="en">

    <?php include('header.php'); ?>

<body>

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php
            include('navheader.php');
            include('sidebar.php');
        ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-md-6 mt-3">
                        <div class="authincation-content">
                            <div class="row no-gutters">
                                <div class="col-xl-12">
                                    <div class="auth-form">
                                        <h4 class="text-center mb-4" style="color: #000000;">Set New Password</h4>
                                        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
                                        <div class="form-group">
                                                <label style="color:#000000;">Enter Current Password</label>
                                                <input type="password" class="form-control" value="Password">
                                            </div>
                                            <div class="form-group">
                                                <label style="color:#000000">Enter New Password</label>
                                                <input type="password" class="form-control" value="Password">
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