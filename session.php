<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'connect.php';

$current_page = basename($_SERVER['PHP_SELF']); // Get current page

if (!isset($_SESSION['email']) || !isset($_SESSION['token'])) {
    if ($current_page != 'login.php') {
        header("Location: login.php");
        exit();
    }
} else {
    $email = $_SESSION['email'];
    $token = $_SESSION['token'];

    $stmt = $conn->prepare("SELECT id FROM accounts WHERE email = ? AND token = ?");
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }

    // Session expiration logic
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > 1800) { // 30 minutes
        session_unset();
        session_destroy();
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Session Expired',
                        text: 'You need to log in again.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'login.php';
                    });
                });
              </script>";
        exit();
    }

    $_SESSION['last_activity'] = time(); // Update last activity timestamp

    // Only redirect if the request is not POST (login form submission)
    if ($current_page == 'login.php' && $_SERVER['REQUEST_METHOD'] != 'POST') {
        header("Location: dashboard.php");
        exit();
    }
}
?>
