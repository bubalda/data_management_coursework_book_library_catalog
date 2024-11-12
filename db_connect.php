<?php

    // db_connect.php
    session_start(); // Start the session at the beginning of your script

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Book_Library_Catalog";

    $conn = null;
    
    // Check if the database connection is already set in the session
    if (isset($_SESSION['db_connection'])) {
        // Create a NEW Database Connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        // Store the connection in a session variable
        $_SESSION['db_connection'] = $conn;
        
        // echo "DB Connected successfully " . $conn->host_info;
        //echo "<br> " .mysqli_get_host_info($conn);
    }
    else {
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        // Use the existing connection from the session
        $conn = $_SESSION['db_connection'];
        // Store the connection in a session variable
        // echo "DB Connected successfully " . $conn->host_info;
    }
    //    mysqli_close($conn);
    ?>