<?php
    include "session.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $entered_password = $_POST["password"] ?? '';
        $email = "talisay@gmail.com";

        // Secure query using prepared statement
        $sql = "SELECT password FROM accounts WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($row = $result->fetch_assoc()) {
            $hashed_password = $row["password"];

            // Verify password using password_verify()
            if (password_verify($entered_password, $hashed_password)) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "message" => "Incorrect password. Try again."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "No user found with this email."]);
        }

        $stmt->close();
        $conn->close();
    }
?>
