<?php
session_start();

date_default_timezone_set('Asia/Manila');

include "connection.php"; 

$empId = $_SESSION['emp_id'];

// Get the current date and time
$currentDateTime = date('H:i:s');

// Update the atlog table with the current time for am_out
$updateAmOutQuery = "UPDATE atlog SET am_out = '$currentDateTime' WHERE emp_id = $empId AND atlog_DATE = CURDATE()";

if ($conn->query($updateAmOutQuery) === TRUE) {
    echo "AM out time logged successfully";
} else {
    echo "Error logging AM out time: " . $conn->error;
}

// Update am_underTIME column
$updateAmUnderTimeQuery = "UPDATE atlog SET am_underTIME = IF(TIMEDIFF(am_out, '11:30:00') > '00:30:00', 'YES', 'NO')";
$conn->query($updateAmUnderTimeQuery);

$conn->close();
?>

