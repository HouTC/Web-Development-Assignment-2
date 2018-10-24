<?php
//Tiancheng Hou, ID: 17967739
//when user click "Search pick-up reuqests" button in the admin page, this php will process search requests

require_once ("../../conf/settings.php");
$conn = @mysqli_connect($host, $user, $pswd, $dbnm) or die("Failed to connect to DB");

// check if the table exists
$query = "SHOW TABLES LIKE 'TaxiBooking'";
$result = @mysqli_query($conn, $query);
if (mysqli_num_rows($result) < 1) {
    echo "TaxiBooking table does not existed in the database, please make booking request at first.<br>";
} else {
    // Set up the SQL command to add the data into the table
    $query = "select BookingNumber, Name, PhoneNumber, Suburb, DestinationSuburb, PickDate
	      , PickTime from TaxiBooking where Status like 'unassigned' and BookingDateTime>NOW()-INTERVAL 2 HOUR";
    
    // executes the query
    $result = mysqli_query($conn, $query);
    
    if (! $result) {
        echo "Somthing wrong with the query.<br>";
    } else {
        // check if the searched booking requests exist in the table.
        if (mysqli_num_rows($result) < 1) {
            echo "There is not unsigned booking
requests with a pick-up time within 2 hours from now<br><br>";
        } else {
            echo "<table border = 1>";
            echo "<tr>\n" . "<th scope=\"col\">Booking Ref Number</th>\n" . "<th scope=\"col\">Name</th>\n" 
                . "<th scope=\"col\">Phone Number</th>\n" . "<th scope=\"col\">Pick-up Suburb</th>\n" 
                    . "<th scope=\"col\">Destination Suburb</th>\n" . "<th scope=\"col\">Pick-up Date</th>\n"
                        . "<th scope=\"col\">Pick-up Time</th>\n". "</tr>\n";
            
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>",$row["BookingNumber"],"</td>";
                echo "<td>",$row["Name"],"</td>";
                echo "<td>",$row["PhoneNumber"],"</td>";
                echo "<td>",$row["Suburb"],"</td>";
                echo "<td>",$row["DestinationSuburb"],"</td>";
                echo "<td>",$row["PickDate"],"</td>";
                echo "<td>",$row["PickTime"],"</td>";
                echo "</tr>";
            }
        }
    }
}

// Frees up the memory, after using the result pointer
mysqli_free_result($result);

// close the database connection
mysqli_close($conn);

?>