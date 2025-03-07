<!--**********************************
    Sidebar start
***********************************-->
    <div class="quixnav" style="background-color: #098209; ">
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
            .quixnav .has-arrow:hover {
                background-color: #0b5e0b !important;
                color: #FFFFFF !important;
            }


            .quixnav a.active {
                background-color: #0b5e0b !important;
                color: #FFFFFF !important;
            }

            .quixnav ul[aria-expanded="true"] li a.active {
                background-color: #0b5e0b !important; 
                color: #FFFFFF !important;
            }

            .quixnav ul[aria-expanded="true"] li a:hover {
                background-color: #157f15 !important;
                color: #FFFFFF !important;
            }

            .quixnav ul[aria-expanded="true"] li a:hover {
                background-color: #157f15 !important;
            }

            .quixnav li:has(.has-arrow) ul {
                background-color: #0b5e0b !important;
            }

            .quixnav li:has(.has-arrow) ul[aria-expanded="true"] {
                background-color: #0b5e0b !important;
            }

            .quixnav li:has(.has-arrow) ul li a {
                color: #FFFFFF !important;
            }

            .quixnav li a.has-arrow:hover {
                background-color: #0b5e0b !important; /* Dark green */
                color: #FFFFFF !important;
            }

            .quixnav li a.has-arrow + ul li a {
                background-color: #0b5e0b !important; /* Keep them consistent */
            }

            .quixnav li a.has-arrow + ul li a {
                background-color: #0b5e0b !important; /* Keep them consistent */
            }

            .quixnav .has-arrow i {
                color: #FFFFFF !important;
            }

            .quixnav.open ul[aria-expanded="true"] {
                display: block !important;
            }

        </style>


    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <!--DASHBOARD-->
            <li>
                <a href="./dashboard.php" aria-expanded="false" style="color: #FFFFFF;"> <i class="icon icon-app-store"></i><span class="nav-text">Dashboard</span> </a>
            </li>
            <!--FILES-->
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false" style="color: #FFFFFF;">
                    <i class="icon icon-folder-15"></i><span class="nav-text">Files</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="./files-resolution.php" style="color: #FFFFFF;">Resolution</a></li>
                    <li><a href="./files-ordinances.php" style="color: #FFFFFF;">Ordinances</a></li>
                    <li><a href="./files-meetingminutes.php" style="color: #FFFFFF;">Meeting Minutes</a></li>
                </ul>
            </li>
            <!--PROFILES-->
            <li>
                <a href="./accountSettings.php" aria-expanded="false" style="color: #FFFFFF;"> <i class="icon icon-settings-gear-64"></i><span class="nav-text">Account Settings</span> </a>
            </li>
            <!--SETTINGS-->
            <li>
                <a href="./manual.php" aria-expanded="false" style="color: #FFFFFF;"> <i class="icon icon-book-open-2"></i><span class="nav-text">Manual</span> </a>
            </li>
        </ul>

    </div>


</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get all menu links
        let menuLinks = document.querySelectorAll('.quixnav a');

        // Check local storage for the active link
        let activeLink = localStorage.getItem('activeMenu');
        if (activeLink) {
            document.querySelectorAll('.quixnav a').forEach(el => {
                if (el.href === activeLink) {
                    el.classList.add('active');
                }
            });
        }

        // Add click event listener
        menuLinks.forEach(link => {
            link.addEventListener('click', function () {
                // Remove active class from all links
                menuLinks.forEach(el => el.classList.remove('active'));

                // Add active class to clicked link
                this.classList.add('active');

                // Store the active menu in local storage
                localStorage.setItem('activeMenu', this.href);
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        let menuToggle = document.querySelector('.hamburger-menu'); // Adjust selector based on your actual menu button
        let sidebar = document.querySelector('.quixnav');

        if (menuToggle) {
            menuToggle.addEventListener('click', function () {
                sidebar.classList.toggle('open');
            });
        }
    });

    document.addEventListener("DOMContentLoaded", function () {
    let menuItems = document.querySelectorAll('.quixnav .has-arrow');

    menuItems.forEach(item => {
        item.addEventListener('click', function () {
            let submenu = this.nextElementSibling;
            let isExpanded = submenu.getAttribute('aria-expanded') === "true";

            // Close all open submenus
            document.querySelectorAll('.quixnav ul[aria-expanded="true"]').forEach(sub => {
                sub.setAttribute('aria-expanded', "false");
                sub.style.display = "none";
            });

            // Toggle the clicked submenu
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