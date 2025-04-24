<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'connect.php';
header('Content-Type: application/json');

$response = ['exists' => false];

$resoNoInput = $_POST['reso_no'] ?? '';

// Normalization function (preserve suffix letters and hyphens)
function normalize($str) {
    $str = strtolower(trim($str));
    // Allow letters, numbers, and hyphens (e.g. 191-a or 191b)
    $str = preg_replace('/[^a-z0-9\-]/', '', $str);
    return $str;
}

// Match: number with optional letters (suffix) + 4-digit year
preg_match('/(\d+[a-zA-Z\-]*)[^0-9]*(\d{4})/', $resoNoInput, $matches);

if (isset($matches[1], $matches[2])) {
    $number = strtolower(trim($matches[1])); // e.g. 191-a or 191b
    $year = $matches[2];

    $inputNormalized = normalize($number . '-' . $year);

    $sql = "SELECT * FROM resolution";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $dbReso = $row['reso_no'];

        preg_match('/(\d+[a-zA-Z\-]*)[^0-9]*(\d{4})/', $dbReso, $dbMatches);

        if (isset($dbMatches[1], $dbMatches[2])) {
            $dbNumber = strtolower(trim($dbMatches[1]));
            $dbYear = $dbMatches[2];
            $dbNormalized = normalize($dbNumber . '-' . $dbYear);

            if ($inputNormalized === $dbNormalized) {
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
                break;
            }
        }
    }
}

echo json_encode($response);
?>
