<?php
    include('dbconn2.php');
    date_default_timezone_set('Europe/London');
    $date = date('Y-m-d');
    $staffname = $_POST["staffname"];
    $query = "SELECT dept FROM staff WHERE name = '$staffname'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
    }

    $dept = $row['dept'];

    // Check if the user has already clocked in today
    $query = "SELECT * FROM attendance WHERE staff_name = '$staffname' AND `date` = '$date'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        echo "You have already clocked in today!";
    }
    else {
        // Record the clock-in entry
        $query = "INSERT INTO attendance (staff_name, dept, `date`) VALUES ('$staffname', '$dept', '$date')";
        mysqli_query($conn, $query);

        echo "Clock-in recorded successfully.";
    }
?>
