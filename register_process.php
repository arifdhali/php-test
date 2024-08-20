<?php
include('./config/database.php');

header('Content-Type: application/json'); 

$response = [
    'success' => false,
    'message' => ''
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $mobile = mysqli_real_escape_string($connect, $_POST['mobile']);
    $password = $_POST['password'];

    $errors = [];

    if (empty($name)) {
        $errors['name'] = "Please enter your name.";
    }

    if (empty($email)) {
        $errors['email'] = "Please enter your email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    }
    if (empty($mobile)) {
        $errors['mobile'] = "Please enter your mobile number.";
    } elseif (!preg_match('/^[0-9]{10}$/', $mobile)) {
        $errors['mobile'] = "Please enter a valid 10-digit mobile number.";
    }
    if (empty($password)) {
        $errors['password'] = "Please enter a password.";
    }

    if (!empty($errors)) {
        $response['message'] = $errors;
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (user_name, user_email, user_mobile, user_password) VALUES (?, ?, ?, ?)";

        if ($stmt = $connect->prepare($sql)) {
            $stmt->bind_param("ssss", $name, $email, $mobile, $hashed_password);
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = "Registration successful!";
            } else {
                $response['message'] = "Error executing query: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $response['message'] = "Error preparing query: " . $connect->error;
        }
    }

    $connect->close();
}

echo json_encode($response);
?>
