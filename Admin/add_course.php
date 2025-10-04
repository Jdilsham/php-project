<?php
    session_start();
    include "../connection.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $img = $_POST['img'];
        $link = $_POST['link'];

        $sql = "INSERT INTO courses (title, description, img, link) VALUES (?, ?, ?, ?)";

        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("ssss", $title, $description, $img, $link);
            if($stmt->execute()){
                header("Location: admin.php?success=Course added successfully");
                exit();
            } else {
                header("Location: admin.php?error=Failed to add course");
                exit();
            }
            $stmt->close();
            
        } else {
            header("Location: admin.php?error=Failed to add course");
        }
    }
?>