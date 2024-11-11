<?php
// Database connection
include 'db_connect.php'; // Includes the connection and starts/resumes the session
//$conn = new mysqli("localhost", "username", "password", "database_name");



// Collect form data
$firstName = $_POST['FirstName'];
$lastName = $_POST['LastName'];
$email = $_POST['Email'];
$birthDate = $_POST['BirthDate'];
$gender = $_POST['Gender'];

// Insert into User table
$sql = "INSERT INTO User (FirstName, LastName, Email, BirthDate, Gender) VALUES ('$firstName', '$lastName', '$email', '$birthDate', '$gender')";

if ($conn->query($sql) === TRUE) {
    // Redirect with JavaScript and show a success message
    echo "<script>
        alert('Record entered successfully!');
        window.location.href = 'InsertRecord.php';
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
