<?php
//Tiancheng Hou, ID: 17967739
//this php file process user inputs from the booking page

//get user inputs
$cname = $_POST['cname'];
$phone  = $_POST['phone'];
$unumber  = $_POST['unumber'];
$snumber  = $_POST['snumber'];
$sname  = $_POST['sname'];
$suburb  = $_POST['suburb'];
$dsurburb  = $_POST['dsurburb'];
$pdate  = $_POST['pdate'];
$ptime  = $_POST['ptime'];

//generate a unique booking reference number
$bookingRef = uniqid();

//generate a status with initial value ¡°unassigned¡±
$bookingStatus = "unassigned";


require_once ("../../conf/settings.php");
$conn = @mysqli_connect($host, $user, $pswd, $dbnm) or die("Failed to connect to DB");

// check if the table exists
$query = "SHOW TABLES LIKE 'TaxiBooking'";
$result = @mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    echo "The TaxiBooking table has existed in the database.<br>";
}
// create table, if there is no table.
else {
    // Frees up the memory, after using result pointer
    mysqli_free_result($result);
    
    $query = "CREATE TABLE TaxiBooking (BookingNumber VARCHAR(255)
        			  , Name VARCHAR(255), PhoneNumber VARCHAR(255)
                      , UnitNumber VARCHAR(255), StreetNumber VARCHAR(255)
                      , StreetName VARCHAR(255), Suburb VARCHAR(255)
                      , DestinationSuburb VARCHAR(255), PickDate VARCHAR(255), PickTime VARCHAR(255)
                      , BookingDateTime VARCHAR(255), Status VARCHAR(255)
        			  , PRIMARY KEY (BookingNumber) )";
    $result = @mysqli_query($conn, $query);
    
    // Frees up the memory, after using the result pointer
    mysqli_free_result($result);
    echo "A new table is created in the database.<br>";
}

// Set up the SQL command to add the data into the table
$query = "insert into TaxiBooking" . "(BookingNumber, Name, PhoneNumber, UnitNumber
	, StreetNumber, StreetName, Suburb, DestinationSuburb, PickDate, PickTime, BookingDateTime, Status)" 
        . "values" . "('$bookingRef','$cname','$phone', '$unumber','$snumber', '$sname','$suburb'
	,'$dsurburb','$pdate','$ptime',now(),'$bookingStatus')";

        // executes the query
        $result = mysqli_query($conn, $query);
        // checks if the execution was successful
        if (! $result) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        } else {
            //return confirmation information to the client, if query operation is successful
            echo "<br>Thank you! Your booking
reference number is ".$bookingRef.". You will be picked up in front of your provided
address at ".$ptime." on ".$pdate.".";
        }
        
        // Frees up the memory, after using the result pointer
        mysqli_free_result($result);
        
        // close the database connection
        mysqli_close($conn);       
?>
 
