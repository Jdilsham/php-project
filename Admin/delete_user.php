<?php
    session_start();
    include "../connection.php";

    if(isset($_GET['id'])){
        $userID = $_GET['id'];

        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();

        if($stmt->affected_rows>0){
            echo "<script>alert('User deleted successfully');</script>";
        }else{
            echo "<script>alert('User cannot Delete');</script>";
        }

        header("Location: admin.php");
        exit();
    }else{
        echo "<script>alert('Invalid User ID');</script>";
        header("Location: admin.php");
        exit();
    }
?>