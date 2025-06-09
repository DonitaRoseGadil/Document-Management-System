<?php
include 'connect.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['official_id'] ?? null;

    if (!$id) {
        echo json_encode(['success' => false, 'message' => 'Official ID is missing.']);
        exit;
    }

    $position = $_POST['position'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $firstname = $_POST['firstname'] ?? '';
    $middlename = $_POST['middlename'] ?? '';
    $birthday = $_POST['birthday'] ?? '';
    $birthplace = $_POST['birthplace'] ?? '';
    $address = $_POST['address'] ?? '';
    $mobile_number = $_POST['mobile_number'] ?? '';
    $email = $_POST['email'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $education_attainment = $_POST['education_attainment'] ?? '';
    $education_school = $_POST['education_school'] ?? '';
    $education_date = $_POST['education_date'] ?? '';
    $civil_status = $_POST['civil_status'] ?? '';
    $spouse_name = $_POST['spouse_name'] ?? '';
    $spouse_birthday = $_POST['spouse_birthday'] ?? '';
    $spouse_birthplace = $_POST['spouse_birthplace'] ?? '';
    $dependents = $_POST['dependents'] ?? '';
    $gsis_number = $_POST['gsis_number'] ?? '';
    $pagibig_number = $_POST['pagibig_number'] ?? '';
    $philhealth_number = $_POST['philhealth_number'] ?? '';

    $photo_path = null;
    if (isset($_FILES['edit_image']) && $_FILES['edit_image']['error'] === 0) {
        $upload_dir = "uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $unique_name = uniqid() . '_' . basename($_FILES['edit_image']['name']);
        $target_path = $upload_dir . $unique_name;

        if (move_uploaded_file($_FILES['edit_image']['tmp_name'], $target_path)) {
            $photo_path = $target_path;
        } else {
            echo json_encode(['success' => false, 'message' => 'Error uploading image.']);
            exit;
        }
    }

    if ($photo_path) {
        $sql = "UPDATE officials SET
            position = ?, surname = ?, firstname = ?, middlename = ?,
            birthday = ?, birthplace = ?, address = ?, mobile_number = ?,
            email = ?, gender = ?, education_attainment = ?, education_school = ?,
            education_date = ?, civil_status = ?, spouse_name = ?, spouse_birthday = ?,
            spouse_birthplace = ?, dependents = ?, gsis_number = ?, pagibig_number = ?,
            philhealth_number = ?, photo_path = ?
            WHERE id = ?";
    } else {
        $sql = "UPDATE officials SET
            position = ?, surname = ?, firstname = ?, middlename = ?,
            birthday = ?, birthplace = ?, address = ?, mobile_number = ?,
            email = ?, gender = ?, education_attainment = ?, education_school = ?,
            education_date = ?, civil_status = ?, spouse_name = ?, spouse_birthday = ?,
            spouse_birthplace = ?, dependents = ?, gsis_number = ?, pagibig_number = ?,
            philhealth_number = ?
            WHERE id = ?";
    }

    $stmt = $conn->prepare($sql);

    if ($photo_path) {
        $stmt->bind_param("ssssssssssssssssssssssi",
            $position, $surname, $firstname, $middlename,
            $birthday, $birthplace, $address, $mobile_number,
            $email, $gender, $education_attainment, $education_school,
            $education_date, $civil_status, $spouse_name, $spouse_birthday,
            $spouse_birthplace, $dependents, $gsis_number, $pagibig_number,
            $philhealth_number, $photo_path, $id
        );
    } else {
        $stmt->bind_param("sssssssssssssssssssssi",
            $position, $surname, $firstname, $middlename,
            $birthday, $birthplace, $address, $mobile_number,
            $email, $gender, $education_attainment, $education_school,
            $education_date, $civil_status, $spouse_name, $spouse_birthday,
            $spouse_birthplace, $dependents, $gsis_number, $pagibig_number,
            $philhealth_number, $id
        );
    }

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Official updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Update failed: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
exit;
?>
