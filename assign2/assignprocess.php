<?php
// Tiancheng Hou, ID: 17967739
// when user enter booking reference number in the admin page, this php will process assign requests

// get booking reference number
$bref = $_POST['bref'];

require_once ("../../conf/settings.php");
$conn = @mysqli_connect($host, $user, $pswd, $dbnm) or die("Failed to connect to DB");

// check if the table exists
$query = "SHOW TABLES LIKE 'TaxiBooking'";
$result = @mysqli_query($conn, $query);
if (mysqli_num_rows($result) < 1) {
    echo "TaxiBooking table does not existed in the database, please make booking request at first.<br>";
} else {
    
    // check if the assigned booking reference number exists in the table.
    $query = "SELECT * FROM TaxiBooking WHERE BookingNumber = '$bref'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) < 1) {
        echo "The assigned booking reference number does not exist in the table.";
    }
    else {
        // Set up the SQL command to add the data into the table
        $query = "UPDATE TaxiBooking SET Status = 'assigned' WHERE BookingNumber = '$bref' ";
        
        // executes the query
        $result = mysqli_query($conn, $query);
        
        if (! $result) {
            echo "Somthing wrong with the query.<br>";
        } else {
            echo "The booking request <" . $bref . "> has been properly assigned.<br>";
        }
    }
}

// Frees up the memory, after using the result pointer
mysqli_free_result($result);

// close the database connection
mysqli_close($conn);

?>