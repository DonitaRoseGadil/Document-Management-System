<!--**********************************
    Sidebar start
***********************************-->
<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <!-- DASHBOARD -->
            <li>
                <a href="./dashboard.php"><i class="icon icon-app-store"></i><span class="nav-text">Dashboard</span></a>
            </li>
            <!-- FILES -->
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="icon icon-folder-15"></i><span class="nav-text">Files</span>
                </a>
                <ul>
                    <li><a href="./files-resolution.php">Resolution</a></li>
                    <li><a href="./files-ordinances.php">Ordinances</a></li>
                    <li><a href="./files-meetingminutes.php">Meeting Minutes</a></li>
                </ul>
            </li>
            <!-- ACCOUNT SETTINGS -->
            <li>
                <a href="./accountSettings.php"><i class="icon icon-settings-gear-64"></i><span class="nav-text">Account Settings</span></a>
            </li>
            <!-- MANUAL -->
            <li>
                <a href="./manual.php"><i class="icon icon-book-open-2"></i><span class="nav-text">Manual</span></a>
            </li>
        </ul>
    </div>
</div>

<!-- External CSS -->
<style>
    .quixnav {
        background-color: #098209 !important;
    }
    .quixnav.open {
        background-color: #0b5e0b !important;
    }
    .quixnav a {
        color: #FFFFFF !important;
        text-decoration: none;
        background-color: transparent !important;
    }
    .quixnav a:hover,
    .quixnav .has-arrow:hover,
    .quixnav a.active,
    .quixnav ul[aria-expanded="true"] li a.active {
        background-color: #0b5e0b !important;
        color: #FFFFFF !important;
    }
    .quixnav ul[aria-expanded="true"] li a:hover {
        background-color: #157f15 !important;
    }
    .quixnav li:has(.has-arrow) ul {
        background-color: #0b5e0b !important;
    }
    .quixnav li a.has-arrow + ul li a {
        background-color: #0b5e0b !important;
    }
    .quixnav .has-arrow i {
        color: #FFFFFF !important;
    }
    .quixnav.open ul[aria-expanded="true"] {
        display: block !important;
    }
</style>

<!-- Optimized JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let menuLinks = document.querySelectorAll('.quixnav a');
        let activeLink = localStorage.getItem('activeMenu');

        if (activeLink) {
            document.querySelectorAll('.quixnav a').forEach(el => {
                if (el.href === activeLink) el.classList.add('active');
            });
        }

        menuLinks.forEach(link => {
            link.addEventListener('click', function () {
                menuLinks.forEach(el => el.classList.remove('active'));
                this.classList.add('active');
                localStorage.setItem('activeMenu', this.href);
            });
        });

        let menuToggle = document.querySelector('.hamburger-menu');
        let sidebar = document.querySelector('.quixnav');

        if (menuToggle) {
            menuToggle.addEventListener('click', function () {
                sidebar.classList.toggle('open');
            });
        }

        let menuItems = document.querySelectorAll('.quixnav .has-arrow');
        menuItems.forEach(item => {
            item.addEventListener('click', function () {
                let submenu = this.nextElementSibling;
                let isExpanded = submenu.getAttribute('aria-expanded') === "true";

                document.querySelectorAll('.quixnav ul[aria-expanded="true"]').forEach(sub => {
                    sub.setAttribute('aria-expanded', "false");
                    sub.style.display = "none";
                });

                if (!isExpanded) {
                    submenu.setAttribute('aria-expanded', "true");
                    submenu.style.display = "block";
                }
            });
        });
    });
</script>

<!--**********************************
    Sidebar end
***********************************-->