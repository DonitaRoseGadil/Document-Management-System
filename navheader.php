<!--**********************************
    Nav header start
***********************************-->
<div class="nav-header" style="background-color: #098209; display: flex; align-items: center;">
    <a href="dashboard.php" class="brand-logo" style="display: flex; align-items: center;">
        <img class="logo-abbr" src="./images/logo.png" alt="">
        <span id="brandText" class="brand-text" style="color: white; font-size: 14px; font-weight: bold; white-space: nowrap; margin-left: 5px;">
            SANGGUNIANG BAYAN OFFICE
        </span>
        <!-- <img class="logo-compact" src="./images/logo-text.png" alt=""> -->
        <!-- <img class="brand-title" src="./images/logo-text.png" alt=""> -->
    </a>

    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const hamburger = document.querySelector(".hamburger");
            const brandText = document.getElementById("brandText");

            hamburger.addEventListener("click", function () {
                brandText.style.display = brandText.style.display === "none" ? "inline-block" : "none";
            });
        });
    </script>
    
</div>
<!--**********************************
    Nav header end
***********************************-->

<!--**********************************
    Header start
***********************************-->
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <!--Search bar is removed-->
                </div>

                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                            <i class="mdi mdi-account"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="logout.php" class="dropdown-item">
                                <i class="icon-key"></i>
                                <span class="ml-2">Logout </span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!--**********************************
    Header end ti-comment-alt
***********************************-->