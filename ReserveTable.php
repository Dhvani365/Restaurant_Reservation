<?php
    // Database connection
    $servername = "localhost";
    $username_db = "root";  
    $password_db = "";     
    $dbname = "test";  
    // Create connection
    $conn = mysqli_connect($servername, $username_db, $password_db, $dbname) or die("Cannot connect to the database: " . mysqli_connect_error());
    // Handle update
    if ($_GET['action'] === 'update') {
        $id = $_GET['id'];  // Assuming 'id' is a unique key for reservations
        $table_no = $_POST['table_no'];
        $date = $_POST['date_reserve'];
        $time = $_POST['time_reserve'];
        $partysize = $_POST['partysize'];
    
        // Corrected column names based on what seems to match your table structure
        $query = "UPDATE reserve SET table_no = '$table_no', date = '$date', time = '$time', partysize = '$partysize' WHERE id = '$id'";
        mysqli_query($conn, $query);
    
        echo "Success";
    }    

    // Handle deletion
    if ($_GET['action'] === 'delete') {
        // Delete reservation
        $id = $_GET['id'];
        // $table_no = $_GET['table_no'];
        $query = "UPDATE reserve SET status='Cancel' WHERE username = '$id'";
        mysqli_query($conn, $query);
        header('Location: reserve.php');
    }

    if(!isset($_GET['action']) || $_GET['action'] !== 'update' || $_GET['action'] !== 'delete'){
        $username = $_POST['username'];
        $table_no = $_POST['table-name'];
        $persons = $_POST['num-persons'];
        $date_res = $_POST['date-reserve'];
        $time_res = $_POST['time-reserve'];

        // Check if any of the required values are empty
        if(empty($username) || empty($table_no) || empty($persons) || empty($date_res) || empty($time_res)){
            echo "<script>
                alert('Please fill in all the required fields.');
                window.location.href = 'reserve.php';
            </script>";
            exit(); // Stop script execution if any value is empty
        }
        // Insert query
        $query = "INSERT INTO reserve (username, table_no, partysize, date, time) VALUES ('$username', '$table_no', $persons, '$date_res', '$time_res')";
        // Execute query
        if(mysqli_query($conn, $query)){
            echo "<script>
                alert('Reservation successful!');
                window.location.href = 'reserve.php';
            </script>";
        }else{
            echo "Can not insert!";
        }
    }

    mysqli_close($conn);
?>