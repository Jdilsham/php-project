<?php
session_start();
include "../connection.php"; // Make sure this path is correct

function validate($data){
    return htmlspecialchars(stripslashes(trim($data)));
}

// Make sure all expected fields exist
if (
    isset($_POST['name']) &&
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['re_password']) &&
    isset($_POST['agree-term'])
) {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);
    $re_pass = validate($_POST['re_password']);
    $agree_term = $_POST['agree-term'];

    // Form validation
    if (empty($name)) {
        header("Location: signup.php?error=Name is required");
        exit();
    } elseif (empty($email)) {
        header("Location: signup.php?error=Email is required");
        exit();
    } elseif (empty($pass)) {
        header("Location: signup.php?error=Password is required");
        exit();
    } elseif ($pass !== $re_pass) {
        header("Location: signup.php?error=Passwords do not match");
        exit();
    } elseif (!$agree_term) {
        header("Location: signup.php?error=You must agree to the terms");
        exit();
    }

    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    // Check if user already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result_check = $stmt->get_result();
    $stmt->close();

    if ($result_check->num_rows > 0) {
        header("Location: signup.php?error=Email already exists");
        exit();
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_pass);

        if ($stmt->execute()) {
            header("Location: ../Login/login.php?success=Registration successful");
            exit();
        } else {
            header("Location: signup.php?error=Database error");
            exit();
        }
    }

} else {
    header("Location: signup.php?error=Please fill all required fields");
    exit();
}

$conn->close();
?>
