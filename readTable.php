<?php
 include 'db_connect.php';

 //include the Sidebar Menu and Header
 include 'sideBarMenu.php';

 $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    else {
        echo "Database Connected successfully";
        //echo $_SESSION['db_connection'];
        //echo "<br> " .mysqli_get_host_info($_SESSION['db_connection']);
    }

    $sql = "SELECT * FROM User"; //Query
    $result = mysqli_query($conn, $sql);

    echo "<br> Total Rows: " . mysqli_num_rows($result);
    echo "<table border='1'>";
    echo "<thead>";
    echo "   <tr>";
    echo "            <th>UserID</th>";
     echo "           <th>FisrtName</th>";
     echo "           <th>LastName</th>";
     echo "           <th>Email</th>";
     echo "           <th>BirthDate</th>";
     echo "           <th>Gender</th>";
     echo "       </tr>";
    if (mysqli_num_rows($result) > 0) {
        
        while($row = mysqli_fetch_assoc($result)){

            echo "<tr style='border:1px green solid'>";
            echo "<td>".$row["UserID"]  ."</td>";
            echo    "<td>".$row['FirstName']. "</td>";
            echo   "<td>".$row['LastName']. "</td>";
            echo   "<td>".$row['Email']. "</td>";
            echo   "<td>".$row['BirthDate']. "</td>";
            echo   "<td>".$row['Gender']."</td>";
        }
    }

?>


<?php

//include the FOOTER Content and END of FILE DATA
include 'footer.php';

?>