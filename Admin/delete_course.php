<?php
    session_start();
    include "../connection.php";

    if(isset($_GET['id'])){
        $courseID = $_GET['id'];

        $sql = "DELETE FROM courses WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $courseID);
        $stmt->execute();

        if($stmt->affected_rows > 0){
            echo "<script>alert('Course deleted successfully');</script>";
        }else{
            echo "<script>alert('Course cannot be deleted');</script>";
        }

        header("Location: admin.php");
        exit();
    }else{
        echo "<script>alert('Invalid Course ID');</script>";
        header("Location: admin.php");
        exit();
    }

?>