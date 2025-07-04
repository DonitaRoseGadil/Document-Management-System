<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Convert to YYYY-MM-DD format
    $term_start = date('Y-m-d', strtotime($_POST['term_start']));
    $term_end = date('Y-m-d', strtotime($_POST['term_end']));

    $stmt = $conn->prepare("DELETE FROM published_terms WHERE term_start = ? AND term_end = ?");
    $stmt->bind_param("ss", $term_start, $term_end);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Term deleted successfully.";
    } else {
        $_SESSION['message'] = "Error deleting term.";
    }

    $stmt->close();
}

header("Location: publishedTerms.php"); // replace with your actual view file
exit;
