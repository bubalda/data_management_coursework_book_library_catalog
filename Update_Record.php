<?php
// Database connection
include 'db_connect.php'; // Includes the connection and starts/resumes the session

//include the Sidebar Menu and Header
include 'sideBarMenu.php';

// Retrieve users
$sql = "SELECT * FROM User"; //Query
//ECECUTE Query and save result 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link rel="stylesheet" href="style.css"> <!-- Add your CSS file here -->
    <script>
        // Function to open edit form in an iframe
        function editUser(userID) {
            document.getElementById('editFrame').src = 'edit_user.php?UserID=' + userID;
            document.getElementById('editModal').style.display = 'block';
        }

        // Function to confirm and delete user
        function deleteUser(userID) {
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = 'delete_user.php?UserID=' + userID;
            }
        }
    </script>
</head>
<body>

<h2>User Management</h2>

<table border="1" class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
    <tr>
        <th>UserID</th>
        <th>FirstName</th>
        <th>LastName</th>
        <th>Email</th>
        <th>BirthDate</th>
        <th>Gender</th>
        <th>Actions</th>
    </tr>
    <?php
    // Display users
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['UserID'] . "</td>";
            echo "<td>" . $row['FirstName'] . "</td>";
            echo "<td>" . $row['LastName'] . "</td>";
            echo "<td>" . $row['Email'] . "</td>";
            echo "<td>" . $row['BirthDate'] . "</td>";
            echo "<td>" . $row['Gender'] . "</td>";
            echo "<td>
                    <button onclick=\"editUser(" . $row['UserID'] . ")\">Edit</button>
                    <button onclick=\"deleteUser(" . $row['UserID'] . ")\">Delete</button>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No users found</td></tr>";
    }
    ?>
</table>

<!-- Modal for editing user -->
<div id="editModal" style="display:none;">
    <iframe id="editFrame" width="100%" height="400px"></iframe>
    <button onclick="document.getElementById('editModal').style.display='none'">Close</button>
</div>

</body>
</html>

<?php
$conn->close();
?>
