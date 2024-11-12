<?php
// Database connection
include 'db_connect.php'; // Includes the connection and starts/resumes the session



// Get UserID from query parameter
$userID = $_GET['UserID'];
$user = null;

// Retrieve user details
if ($userID) {
    $sql = "SELECT * FROM User WHERE UserID = $userID";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

// Update user information when form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $email = $_POST['Email'];
    $birthDate = $_POST['BirthDate'];
    $gender = $_POST['Gender'];
    
    $updateSql = "UPDATE User SET FirstName='$firstName', LastName='$lastName', Email='$email', BirthDate='$birthDate', Gender='$gender' WHERE UserID = $userID";
    
    if ($conn->query($updateSql) === TRUE) {
        echo "<script>alert('User updated successfully!'); window.parent.location.reload();</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

//$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>
<body>
<h2>Edit User</h2>

<?php if ($user): ?>
    <form method="post" action="">
        <label>First Name:</label>
        <input type="text" name="FirstName" value="<?php echo $user['FirstName']; ?>"><br>

        <label>Last Name:</label>
        <input type="text" name="LastName" value="<?php echo $user['LastName']; ?>"><br>

        <label>Email:</label>
        <input type="email" name="Email" value="<?php echo $user['Email']; ?>"><br>

        <label>Birth Date:</label>
        <input type="date" name="BirthDate" value="<?php echo $user['BirthDate']; ?>"><br>

        <label>Gender:</label>
        <input type="text" name="Gender" value="<?php echo $user['Gender']; ?>"><br>

        <button type="submit">Save</button>
    </form>
<?php else: ?>
    <p>User not found.</p>
<?php endif; ?>

</body>
</html>
