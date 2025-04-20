<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'connect.php';
header('Content-Type: application/json');

$response = ['exists' => false];

$moNoInput = $_POST['mo_no'] ?? '';

// Normalization function
function normalize($str) {
    return preg_replace('/[^0-9\-]/', '', strtolower(trim($str)));
}

// Get all number-year pairs from input (e.g., Resolution No. 043-2024 / MO No. 05-2024)
preg_match_all('/\b(?:mo\s*no\.?|reso(?:lution)?\s*no\.?)?\s*(\d{1,4})[\s\-\/\.]*(\d{4})/i', $moNoInput, $inputMatches, PREG_SET_ORDER);

// Normalize all input matches
$normalizedInput = [];
foreach ($inputMatches as $match) {
    $normalizedInput[] = normalize(ltrim($match[1], '0') . '-' . $match[2]);
}

if (!empty($normalizedInput)) {
    $sql = "SELECT * FROM ordinance";
    $result = $conn->query($sql);

    if (!$result) {
        echo json_encode([
            'error' => true,
            'message' => 'Database query failed: ' . $conn->error
        ]);
        exit;
    }

    while ($row = $result->fetch_assoc()) {
        $dbMoNo = $row['mo_no'] ?? '';

        // Extract and normalize number-year pairs from DB value
        preg_match_all('/\b(?:mo\s*no\.?|reso(?:lution)?\s*no\.?)?\s*(\d{1,4})[\s\-\/\.]*(\d{4})/i', $dbMoNo, $dbMatches, PREG_SET_ORDER);
        $normalizedDB = [];

        foreach ($dbMatches as $match) {
            $normalizedDB[] = normalize(ltrim($match[1], '0') . '-' . $match[2]);
        }

        // Check if ALL input parts exist in the DB version
        $allMatch = !array_diff($normalizedInput, $normalizedDB);

        if ($allMatch) {
            $response['exists'] = true;
            $response['title'] = $row['title'];
            $response['dateAdopted'] = $row['date_adopted'];
            $response['authorSponsor'] = $row['author_sponsor'];
            $response['remarks'] = $row['remarks'];
            $response['dateForwarded'] = $row['date_fwd'];
            $response['dateSigned'] = $row['date_signed'];
            $response['dateApproved'] = $row['sp_approval'];
            $response['spResoNo'] = $row['sp_resoNo'];        
            // $response['returnNo'] = $row['return_no'];          
            // $response['returnDate'] = $row['return_date'];      
            $response['attachment'] = $row['attachment'];
            $response['notes'] = $row['notes'];
            break;
        }
    }
}

echo json_encode($response);
?>
