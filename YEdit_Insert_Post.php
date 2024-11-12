<?php
// Database connection
include 'db_connect.php'; // Includes the connection and starts/resumes the session




// Collect form data
$userID = $_POST['UserID'];
$postText = $_POST['PostText'];
$imageURL = $_POST['ImageURL'];
$videoURL = $_POST['VideoURL'];
$postDateTime = $_POST['PostDateTime'];
$hashtag = $_POST['Hashtag'];
$mentionedUserID = $_POST['MentionedUserID'];

// Insert hashtag if it doesn't already exist
$hashtagID = null;
$hashtagQuery = "SELECT HashtagID FROM Hashtag WHERE Hashtag = '$hashtag'";
$result = $conn->query($hashtagQuery);

if ($result->num_rows > 0) {
    // Hashtag exists, get ID
    $row = $result->fetch_assoc();
    $hashtagID = $row['HashtagID'];
} else {
    // Insert new hashtag and get ID
    $conn->query("INSERT INTO Hashtag (Hashtag) VALUES ('$hashtag')");
    $hashtagID = $conn->insert_id;
}

// Insert into Post table
$conn->query("INSERT INTO Post (UserID, PostText, ImageURL, VideoURL, PostDateTime, HashtagID) VALUES ('$userID', '$postText', '$imageURL', '$videoURL', '$postDateTime', '$hashtagID')");
$postID = $conn->insert_id;

// Insert into User_Post table
$conn->query("INSERT INTO User_Post (UserID, PostID) VALUES ('$userID', '$postID')");

// Insert into Mention table if a mentioned user was provided
if (!empty($mentionedUserID)) {
    $conn->query("INSERT INTO Mention (UserID, PostID) VALUES ('$mentionedUserID', '$postID')");
}

// Redirect with a success message
echo "<script>
    alert('Record entered successfully!');
    window.location.href = 'InsertRecord.php';
</script>";

$conn->close();
?>
