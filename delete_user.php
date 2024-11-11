<?php
// Database connection
include 'db_connect.php'; // Includes the connection and starts/resumes the session



// Get UserID from query parameter
$userID = $_GET['UserID'];

// Delete user record
if ($userID) {
    $sql = "DELETE FROM User WHERE UserID = $userID";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('User deleted successfully!'); window.location.href = 'Update_Record.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

//$conn->close();
?>
