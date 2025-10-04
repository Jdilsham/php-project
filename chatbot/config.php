<?php
    // config.php

    $servername = "localhost";
    $username = "root";
    $password = "";

    // create connection
    $conn = mysqli_connect($servername, $username, $password);

    if(!$conn) {
        die("Connection failed : " . mysqli_connect_error());
    }
    else {
        echo "Connected successfully !";
    }

?>