<?php
    session_start();
    include "../connection.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";

        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("sss", $name, $email, $hashed_password);
            if($stmt->execute()){
                header("Location: admin.php?success=User added successfully");
                exit();
            } else {
                header("Location: admin.php?error=Failed to add user");
                exit();
            }
            $stmt->close();
            
        } else {
            header("Location: admin.php?error=Failed to add user");
        }

    }



?>