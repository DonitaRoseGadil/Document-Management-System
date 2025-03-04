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

    // Only redirect if the request is not POST (login form submission)
    if ($current_page == 'login.php' && $_SERVER['REQUEST_METHOD'] != 'POST') {
        header("Location: dashboard.php");
        exit();
    }
}
?>
