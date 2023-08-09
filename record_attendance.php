<?php
include('dbconn2.php'); // Include your database connection

if(isset($_POST['staffname']) && isset($_POST['dept']) && isset($_POST['date'])) {
    $staffname = $_POST['staffname'];
    $dept = $_POST['dept'];
    $date = $_POST['date'];

    // Insert attendance record into the 'attendance' table
    $query = "INSERT INTO attendance (staff_name, dept, date) VALUES ('$staffname', '$dept', '$date')";
    
    if(mysqli_query($conn, $query)) {
        echo "Attendance recorded successfully.";
    } else {
        echo "Error recording attendance: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
