<?php
    include('dbconn2.php');

    if(isset($_POST['staffname'])) {
        $staffname = $_POST['staffname'];
        $date = date('Y-m-d');
        
        // Retrieve department for the staff member
        $query = "SELECT dept FROM staff WHERE name = '$staffname'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $dept = $row['dept'];

            // Check if the user has already clocked in today
            $query = "SELECT * FROM attendance WHERE staff_name = '$staffname' AND `date` = '$date'";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) > 0) {
                echo "You have already clocked in today!";
            }
            else {
                // Record the clock-in entry
                $insert_query = "INSERT INTO attendance (staff_name, dept, `date`) VALUES ('$staffname', '$dept', '$date')";
                if(mysqli_query($conn, $insert_query)) {
                    echo "Clock-in recorded successfully.";
                } else {
                    echo "Error recording clock-in: " . mysqli_error($conn);
                }
            }
        } else {
            echo "Staff not found.";
        }
    } else {
        echo "Invalid request.";
    }
?>
