<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'connect.php';
header('Content-Type: application/json');

$response = ['exists' => false];

$resoNoInput = $_POST['reso_no'] ?? '';

// Normalize input (e.g., remove extra spaces, lowercase)
function normalize($str) {
    $str = strtolower(trim($str));
    // Keep only digits and hyphen, ignore everything else
    $str = preg_replace('/[^0-9\-]/', '', $str);
    return $str;
}

// Try to extract number and year (e.g., from "181 s.2024" or "Resolution No. 181-2024")
preg_match('/(\d+)[^\d]*(\d{4})/', $resoNoInput, $matches);

if (isset($matches[1], $matches[2])) {
    $number = ltrim($matches[1], '0'); // Remove leading zeroes
    $year = $matches[2];

    $inputNormalized = normalize($number . '-' . $year);

    // Fetch all resolution numbers and compare after normalization
    $sql = "SELECT * FROM resolution";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $dbReso = $row['reso_no'];
        
        // Normalize DB value
        preg_match('/(\d+)[^\d]*(\d{4})/', $dbReso, $dbMatches);

        if (isset($dbMatches[1], $dbMatches[2])) {
            $dbNumber = ltrim($dbMatches[1], '0');
            $dbYear = $dbMatches[2];
            $dbNormalized = normalize($dbNumber . '-' . $dbYear);

            if ($inputNormalized === $dbNormalized) {
                // Match found
                $response['exists'] = true;
                $response['title'] = $row['title'];
                $response['dateAdopted'] = $row['d_adopted'];
                $response['authorSponsor'] = $row['author_sponsor'];
                $response['coAuthor'] = $row['co_author'];
                $response['remarks'] = $row['remarks'];
                $response['dateForwarded'] = $row['d_forward'];
                $response['dateSigned'] = $row['d_signed'];
                $response['dateApproved'] = $row['d_approved'];
                $response['attachment'] = $row['attachment'];
                $response['notes'] = $row['notes'];
                break; // Stop checking once a match is found
            }
        }
    }
}

echo json_encode($response);
?>
