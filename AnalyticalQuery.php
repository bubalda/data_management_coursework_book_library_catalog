<?php
    include 'db_connect.php'; // Includes the connection and starts/resumes the session
    //session_start(); // Start the session at the beginning of your script
    

    //include the Sidebar Menu and Header
    include 'sideBarMenu.php';
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">
                   

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Analytical Queries</h1>
                    <p class="mb-4">All Analytical Queries and Their results are shown here.
                        </p>
                    
                        <?php
                        // Create connection
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
                        // Check connection
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        else {
                            echo "Database Connected successfully";
                        }
                        //***************************** */
                        // Example Query 1
                        $sql = "SELECT b.BookName, a.AuthorName, COUNT(f.BookISBN) AS FavoriteCount
                        FROM favourites f
                        INNER JOIN book b ON f.BookISBN = b.BookISBN
                        JOIN author a ON b.AuthorID = a.AuthorID
                        GROUP BY f.BookISBN
                        ORDER BY FavoriteCount DESC
                        LIMIT 5;";
                        $queryTitle = "Query-1";
                        $queryDescription = "Retrieve the Top 5 Most Favourited Books And Their Authors";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql, $queryTitle, $queryDescription);
                        
                        //***************************** */
                        // Example Query 2
                        $sql = "SELECT b.BookName, r.Stars
                        FROM rating r
                        LEFT JOIN book b ON r.BookISBN = b.BookISBN
                        WHERE r.Stars >= 4";
                        $queryTitle = "Query-2";
                        $queryDescription = "Retrieve Books With A Minimum of 4 Stars";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql, $queryTitle, $queryDescription);

                        //***************************** */
                        // Example Query 3
                        $sql = "SELECT b.BookName, COUNT(bh.BorrowID) AS BorrowCount
                        FROM book b
                        INNER JOIN borrowhistory bh ON b.BookISBN = bh.BookISBN
                        GROUP BY b.BookISBN
                        ORDER BY BorrowCount DESC;";
                        $queryTitle = "Query-3";
                        $queryDescription = "Count How Many Times Each Book Has Been Borrowed";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql, $queryTitle, $queryDescription);
                        
                        //***************************** */
                        // Example Query 4
                        $sql = "SELECT u.UserName, b.BookName, bh.BorrowDate
                        FROM borrowhistory bh
                        JOIN user u ON bh.UserID = u.UserID
                        JOIN book b ON bh.BookISBN = b.BookISBN
                        WHERE bh.ReturnDate IS NULL;";
                        $queryTitle = "Query-4";
                        $queryDescription = "Find All Users Who Have Not Returned A Borrowed Book";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql, $queryTitle, $queryDescription);
                        
                        //***************************** */
                        // Example Query 5
                        $sql = "SELECT u.UserName, b.BookName, bh.BorrowDate
                        FROM borrowhistory bh
                        JOIN user u ON bh.UserID = u.UserID
                        JOIN book b ON bh.BookISBN = b.BookISBN
                        WHERE bh.ReturnDate IS NOT NULL;";
                        $queryTitle = "Query-5";
                        $queryDescription = "Find All Users Who Have Returned A Borrowed Book";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql, $queryTitle, $queryDescription);
                        
                        //***************************** */
                        // Example Query 6
                        $sql = "SELECT BookName, AvailableCount
                        FROM book
                        WHERE AvailableCount < 3;";
                        $queryTitle = "Query-6";
                        $queryDescription = "Find All Books With Less Than 3 Available Copies";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql, $queryTitle, $queryDescription);
                        
                        //***************************** */
                        // Example Query 7
                        $sql = "SELECT u.UserName, b.BookName, r.Stars, r.Comments
                        FROM rating r
                        JOIN user u ON r.UserID = u.UserID
                        JOIN book b ON r.BookISBN = b.BookISBN
                        WHERE r.Comments IS NOT NULL;";
                        $queryTitle = "Query-7";
                        $queryDescription = "Find All Ratings Where Users Have Left a Comment";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql, $queryTitle, $queryDescription);
                        
                        //***************************** */
                        // Example Query 8
                        $sql = "SELECT u.UserName, b.BookName, r.Stars
                        FROM rating r
                        JOIN user u ON r.UserID = u.UserID
                        JOIN book b ON r.BookISBN = b.BookISBN
                        WHERE r.Comments IS NULL;";
                        $queryTitle = "Query-8";
                        $queryDescription = "Find All Ratings Where Users Have Not Left a Comment";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql, $queryTitle, $queryDescription);
                        
                        //***************************** */
                        // Example Query 9
                        $sql = "SELECT u.UserName, COUNT(f.FavouritesID) AS FavoriteCount
                        FROM user u
                        RIGHT JOIN favourites f ON u.UserID = f.UserID
                        GROUP BY u.UserID
                        HAVING FavoriteCount > 2;
                        ";
                        $queryTitle = "Query-9";
                        $queryDescription = "Find Users Who Have Favorited More Than 2 Books";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql, $queryTitle, $queryDescription);
                        
                        //***************************** */
                        // Example Query 10
                        $sql = "SELECT u.UserID, ROUND(AVG(bh.LateFees), 2) AS AvgLateFees
                        FROM user u
                        RIGHT JOIN borrowhistory bh ON bh.UserID = u.UserID
                        WHERE bh.LateFees IS NOT NULL
                        GROUP BY bh.UserID;";
                        $queryTitle = "Query-10";
                        $queryDescription = "Find Average Late Fees From All Users With Late Returns";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql, $queryTitle, $queryDescription);
                        
                        //***************************** */
                        // Example Query 11
                        $sql = "SELECT b.BookName, COUNT(r.RatingID) AS RatingCount
                        FROM book b
                        JOIN rating r ON b.BookISBN = r.BookISBN
                        GROUP BY b.BookISBN
                        ORDER BY RatingCount DESC;";
                        $queryTitle = "Query-11";
                        $queryDescription = "Count the Total Number of Times Each Book Has Been Rated";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql, $queryTitle, $queryDescription);
                        
                        //***************************** */
                        // Example Query 12
                        $sql = "SELECT u.UserName, b.BookName, bb.Page, bb.DateCreated
                        FROM User u
                        RIGHT JOIN BookmarkedBook bb ON u.UserID = bb.UserID
                        INNER JOIN book b ON b.BookISBN = bb.BookISBN
                        WHERE bb.DateCreated = (SELECT MAX(DateCreated) FROM BookmarkedBook WHERE UserID = u.UserID)
                        ORDER BY u.UserName;";
                        $queryTitle = "Query-12";
                        $queryDescription = "Find the Most Recent Bookmarks by Each User";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql, $queryTitle, $queryDescription);
                        
                        //***************************** */
                        // Example Query 13
                        $sql = "SELECT g.GenreName, COUNT(bg.GenreID) AS GenreCount
                        FROM BookGenre bg
                        LEFT JOIN Genre g ON g.GenreID = bg.GenreID
                        GROUP BY g.GenreName
                        ORDER BY GenreCount DESC;";
                        $queryTitle = "Query-13";
                        $queryDescription = "Order Genres By The Number Of Books";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql, $queryTitle, $queryDescription);
                        
                        //***************************** */
                        // Example Query 14
                        $sql = "SELECT u.UserName, COUNT(bh.BorrowID) AS BorrowCount
                        FROM User u
                        INNER JOIN BorrowHistory bh ON u.UserID = bh.UserID
                        GROUP BY u.UserID
                        ORDER BY BorrowCount
                        LIMIT 10;";
                        $queryTitle = "Query-14";
                        $queryDescription = "Find The Top 10 Most Active Library Users";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql, $queryTitle, $queryDescription);
                        
                        //***************************** */
                        // Example Query 15
                        $sql = "SELECT BookName, PublishedYear
                        FROM book
                        ORDER BY PublishedYear ASC;";
                        $queryTitle = "Query-15";
                        $queryDescription = "Show Book Catalogue By Oldest Books";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql, $queryTitle, $queryDescription);
                        
                        //***************************** */
                        // Example Query 16
                        $sql = "SELECT UserName
                        FROM user
                        WHERE UserPermissionLevel = 2;";
                        $queryTitle = "Query-16";
                        $queryDescription = "Return All Users Having Permission Level 2";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql, $queryTitle, $queryDescription);
                        
                        //***************************** */
                        // Example Query 17
                        $sql = "SELECT a.AuthorName, COUNT(f.FollowingID) AS FollowingCount 
                        FROM author a 
                        INNER JOIN following f ON a.AuthorID = f.AuthorID 
                        GROUP BY a.AuthorID 
                        ORDER BY FollowingCount DESC;";
                        $queryTitle = "Query-17";
                        $queryDescription = "Find The Author With The Largest Following";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql, $queryTitle, $queryDescription);
                        
                        //***************************** */
                        // Example Query 18
                        $sql = "SELECT a.AuthorName, COUNT(b.BookISBN) AS BookCount
                        FROM author a
                        INNER JOIN book b ON b.AuthorID = a.AuthorID
                        GROUP BY a.AuthorName
                        ORDER BY BookCount DESC;";
                        $queryTitle = "Query-18";
                        $queryDescription = "Find the Author With the Most Published Books";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql, $queryTitle, $queryDescription);
                        
                        //***************************** */
                        // Example Query 19
                        $sql = "SELECT u.UserName, SUM(bh.LateFees) AS UserLateFees 
                        FROM user u 
                        INNER JOIN borrowhistory bh ON u.UserID = bh.UserID 
                        WHERE bh.LateFees IS NOT NULL 
                        GROUP BY u.UserName 
                        ORDER BY UserLateFees DESC;";
                        $queryTitle = "Query-19";
                        $queryDescription = "Find Users By Highest Total Late Fees";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql, $queryTitle, $queryDescription);
                        
                        //***************************** */
                        // Example Query 20
                        $sql = "SELECT u.UserName, u.UserEmail 
                        FROM User u 
                        WHERE u.UserEmail LIKE '%yahoo%';";
                        $queryTitle = "Query-20";
                        $queryDescription = "Find All Users Having Yahoo In Email Domain";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql, $queryTitle, $queryDescription);
                        
                        // Add more queries as needed...
                        ?>

                </div> 
                <!-- /.container-fluid -->

<?php

//include the FOOTER Content and END of FILE DATA
include 'footer.php';

?>

<?php
/// *** NO NEED TO CHANGE ANYTHING BELOW THIS LINE *** ///

// Function to execute the query and generate the table
function generate_table($conn, $sql, $queryTitle, $queryDescription) {
    echo '<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">' . $queryTitle . '</h6>
                <p class="mb-4">' . $queryDescription . '</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">';
    
    // Execute the Query
    $result = mysqli_query($conn, $sql);

    // Display the number of rows
    echo "<br> Total Rows: " . mysqli_num_rows($result);

    if (mysqli_num_rows($result) > 0) {
        // Display table header with column names dynamically
        echo "<table border='1' class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
        echo "<tr>";
        
        $firstRow = mysqli_fetch_assoc($result);
        // Loop through and print all column names
        foreach ($firstRow as $columnName => $value) {
            echo "<th>" . htmlspecialchars($columnName) . "</th>";
        }
        echo "</tr>";

        // Reset the pointer to the first row
        mysqli_data_seek($result, 0);

        // Output data of each row dynamically
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            foreach ($row as $columnValue) {
                echo "<td>" . htmlspecialchars($columnValue) . "</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "0 results";
    }

    echo '    </div>
            </div>
        </div>';
}
?>
