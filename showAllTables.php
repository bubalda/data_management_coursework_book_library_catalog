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
                    <p class="mb-4">All Analytical Queries and Their results will be shown here From WEEK-5 Lab Handout.
                        </p>
                    
                        <?php
                        //***************************** */
                        // Example Query 1
                        $sql1 = "SELECT * FROM author"; //Query
                        $queryTitle1 = "Author Table";
                        $queryDescription1 = "Show All Author Table Records";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql1, $queryTitle1, $queryDescription1);

                        //***************************** */
                        // Example Query 2
                        $sql1 = "SELECT * FROM book"; //Query
                        $queryTitle1 = "Books Table";
                        $queryDescription1 = "Show All Books Table Records";

                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql1, $queryTitle1, $queryDescription1);

                        //***************************** */
                        // Example Query 3
                        $sql1 = "SELECT * FROM rating"; //Query
                        $queryTitle1 = "Ratings Table";
                        $queryDescription1 = "Show All rating Table Records";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql1, $queryTitle1, $queryDescription1);

                        //***************************** */
                        // Example Query 4
                        $sql1 = "SELECT * FROM bookgenre"; //Query
                        $queryTitle1 = "BookGenres Table";
                        $queryDescription1 = "Show All Books' Genres Table Records";

                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql1, $queryTitle1, $queryDescription1);
                        
                        //***************************** */
                        // Example Query 5
                        $sql1 = "SELECT * FROM bookmarkedbook"; //Query
                        $queryTitle1 = "BookmarkedBooks Table";
                        $queryDescription1 = "Show All Bookmarked Books' Table Records";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql1, $queryTitle1, $queryDescription1);
                        
                        //***************************** */
                        // Example Query 6
                        $sql1 = "SELECT * FROM borrowhistory"; //Query
                        $queryTitle1 = "BorrowHistory Table";
                        $queryDescription1 = "Show All Borrow History Table Records";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql1, $queryTitle1, $queryDescription1);
                        
                        
                        //***************************** */
                        // Example Query 7
                        $sql1 = "SELECT * FROM favourites"; //Query
                        $queryTitle1 = "Favourites Table";
                        $queryDescription1 = "Show All Favourites Table Records";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql1, $queryTitle1, $queryDescription1);

                        //***************************** */
                        // Example Query 8
                        $sql1 = "SELECT * FROM following"; //Query
                        $queryTitle1 = "Following Table";
                        $queryDescription1 = "Show All Following Table Records";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql1, $queryTitle1, $queryDescription1);

                        //***************************** */
                        // Example Query 9
                        $sql1 = "SELECT * FROM genre"; //Query
                        $queryTitle1 = "Genres Table";
                        $queryDescription1 = "Show All Genres Table Records";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql1, $queryTitle1, $queryDescription1);

                        //***************************** */
                        // Example Query 10
                        $sql1 = "SELECT * FROM user"; //Query
                        $queryTitle1 = "User Table";
                        $queryDescription1 = "Show All User Table Records";
                        //CALL FUNCTION to generate table
                        generate_table($conn, $sql1, $queryTitle1, $queryDescription1);

                        // Add more queries as needed...
                        ?>
                    
                </div> 
                <!-- /.container-fluid -->

<?php

//include the FOOTER Content and END of FILE DATA
include 'footer.php';

?>

<?php
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
