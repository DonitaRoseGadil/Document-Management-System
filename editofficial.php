<?php
include 'connect.php';

header('Content-Type: application/json'); // Tell JS to expect JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect POST data
    $id = $_POST['id'];
    $position = $_POST['position'];
    $term_start = $_POST['term_start'];
    $term_end = $_POST['term_end'];
    $surname = $_POST['surname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $birthday = $_POST['birthday'];
    $birthplace = $_POST['birthplace'];
    $address = $_POST['address'];
    $mobile_number = $_POST['contact'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $education_attainment = $_POST['education_attainment'];
    $education_school = $_POST['education_school'];
    $education_date = $_POST['education_date'];
    $civil_status = $_POST['civil_status'];
    $spouse_name = $_POST['spouse_name'];
    $spouse_birthday = $_POST['spouse_birthday'];
    $spouse_birthplace = $_POST['spouse_birthplace'];
    $dependents = $_POST['dependents'];
    $gsis_number = $_POST['gsis_number'];
    $pagibig_number = $_POST['pagibig_number'];
    $philhealth_number = $_POST['philhealth_number'];

    // Handle photo upload
    $photo_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $target_dir = "uploads/photos/";
        $file_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . uniqid() . "_" . $file_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $photo_path = $target_file;
        } else {
            echo json_encode(['success' => false, 'message' => 'Photo upload failed.']);
            exit;
        }
    }

    // Prepare query
    if ($photo_path) {
        $sql = "UPDATE officials SET
            position = ?, term_start = ?, term_end = ?, surname = ?, firstname = ?, middlename = ?,
            birthday = ?, birthplace = ?, address = ?, mobile_number = ?,
            email = ?, gender = ?, education_attainment = ?, education_school = ?,
            education_date = ?, civil_status = ?, spouse_name = ?, spouse_birthday = ?,
            spouse_birthplace = ?, dependents = ?, gsis_number = ?, pagibig_number = ?,
            philhealth_number = ?, photo_path = ?
            WHERE id = ?";
    } else {
        $sql = "UPDATE officials SET
            position = ?, term_start = ?, term_end = ?, surname = ?, firstname = ?, middlename = ?,
            birthday = ?, birthplace = ?, address = ?, mobile_number = ?,
            email = ?, gender = ?, education_attainment = ?, education_school = ?,
            education_date = ?, civil_status = ?, spouse_name = ?, spouse_birthday = ?,
            spouse_birthplace = ?, dependents = ?, gsis_number = ?, pagibig_number = ?,
            philhealth_number = ?
            WHERE id = ?";
    }

    $stmt = $conn->prepare($sql);

    if ($photo_path) {
        $stmt->bind_param("ssssssssssssssssssssssssi",
            $position, $term_start, $term_end, $surname, $firstname, $middlename,
            $birthday, $birthplace, $address, $mobile_number,
            $email, $gender, $education_attainment, $education_school,
            $education_date, $civil_status, $spouse_name, $spouse_birthday,
            $spouse_birthplace, $dependents, $gsis_number, $pagibig_number,
            $philhealth_number, $photo_path, $id
        );
    } else {
        $stmt->bind_param("sssssssssssssssssssssssi",
            $position, $term_start, $term_end, $surname, $firstname, $middlename,
            $birthday, $birthplace, $address, $mobile_number,
            $email, $gender, $education_attainment, $education_school,
            $education_date, $civil_status, $spouse_name, $spouse_birthday,
            $spouse_birthplace, $dependents, $gsis_number, $pagibig_number,
            $philhealth_number, $id
        );
    }

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
