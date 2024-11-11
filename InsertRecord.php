<?php
    include 'db_connect.php'; // Includes the connection and starts/resumes the session
    //session_start(); // Start the session at the beginning of your script
    

    //include the Sidebar Menu and Header
    include 'sideBarMenu.php';
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">
                   

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Insert New User Record </h1>
                    <!-- <p class="mb-4">All Analytical Queries and Their results will be shown here From WEEK-5 Lab Handout.
                        </p> -->
                    
                    <h2>Enter New User Details</h2>
                    <form action="Insert_User.php" method="post">
                        <label>First Name:</label>
                        <input type="text" name="FirstName" required><br>
                        
                        <label>Last Name:</label>
                        <input type="text" name="LastName" required><br>
                        
                        <label>Email:</label>
                        <input type="email" name="Email" required><br>
                        
                        <label>Birth Date:</label>
                        <input type="date" name="BirthDate" required><br>
                        
                        <label>Gender:</label>
                        <select name="Gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select><br>
                        
                        <input type="submit" value="Add User">
                    </form>


                   
                    

                    
                </div> 
                <!-- /.container-fluid -->

                <br> <br> 
                <hr>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                   

                    <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Insert POST Record </h1>
                <h2>Enter New Post Details</h2>
                <form action="Insert_Post.php" method="post">
                    <label>User ID:</label>
                    <input type="number" name="UserID" required><br>
                    
                    <label>Post Text:</label>
                    <textarea name="PostText" width="50%" required></textarea><br>
                    
                    <label>Image URL:</label>
                    <input type="text" name="ImageURL"><br>
                    
                    <label>Video URL:</label>
                    <input type="text" name="VideoURL"><br>
                    
                    <label>Post Date and Time:</label>
                    <input type="datetime-local" name="PostDateTime" required><br>
                    
                    <label>Hashtag (e.g., #example):</label>
                    <input type="text" name="Hashtag"><br>
                    
                    <label>Mentioned User ID (optional):</label>
                    <input type="number" name="MentionedUserID"><br>
                    
                    <input type="submit" value="Add Post">
                </form>
            </div> 
            <!-- /.container-fluid -->

<?php

//include the FOOTER Content and END of FILE DATA
include 'footer.php';

?>

