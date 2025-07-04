<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connect.php';
include 'header.php';

$query = $conn->query("
    SELECT term_start, term_end 
    FROM officials 
    GROUP BY term_start, term_end 
    ORDER BY term_start DESC 
    LIMIT 1
");

$current = $query->fetch_assoc();

if ($current) {
    $term_start = $current['term_start'];
    $term_end = $current['term_end'];

    // ✅ Step 2: Fetch all officials under this term
    $stmt = $conn->prepare("
        SELECT surname, firstname, middlename, position, photo_path 
        FROM officials 
        WHERE term_start = ? AND term_end = ? 
        ORDER BY 
            FIELD(position, 'Vice-Mayor', 'Councilor', 'LNB', 'PPSK'),
            surname, firstname
    ");
    $stmt->bind_param("ss", $term_start, $term_end);
    $stmt->execute();
    $officials = $stmt->get_result();

    if ($officials->num_rows > 0) {
        $delete = $conn->prepare("DELETE FROM published_terms WHERE term_start = ? AND term_end = ?");
        $delete->bind_param("ss", $term_start, $term_end);
        $delete->execute();

        $insert = $conn->prepare("
            INSERT INTO published_terms 
            (name, position, photo_path, term_start, term_end) 
            VALUES (?, ?, ?, ?, ?)
        ");
        while ($official = $officials->fetch_assoc()) {
            $full_name = $official['surname'] . ', ' . $official['firstname'] . ' ' . $official['middlename'];
            $insert->bind_param("sssss", $full_name, $official['position'], $official['photo_path'], $term_start, $term_end);
            $insert->execute();
        }

        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Published!',
                    text: 'Organization chart has been updated for the term: " . date('F j, Y', strtotime($term_start)) . " – " . date('F j, Y', strtotime($term_end)) . "',
                    confirmButtonColor: '#098209'
                }).then(() => {
                    window.location.href = 'files-officials.php';
                });
            });
        </script>";
    } else {
        // ❌ No officials found for that term
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'No Officials Found',
                    text: 'The most recent term has no officials. Nothing was published.',
                    confirmButtonColor: '#d33'
                }).then(() => {
                    window.location.href = 'files-officials.php';
                });
            });
        </script>";
    }

} else {
    // ❌ No term found in officials
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'No Term Found',
                text: 'No term found in the officials table to publish.',
                confirmButtonColor: '#d33'
            }).then(() => {
                window.location.href = 'files-officials.php';
            });
        });
    </script>";
}
?>
