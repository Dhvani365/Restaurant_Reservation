<?php
    include 'session_check.php'; 
    // session_start();
    $uid = "dhvani365";
    if (isset($_SESSION['username'])) {
        $uid = (string)$_SESSION['username'];
    } 

    // Database connection
    $servername = "localhost";
    $username_db = "root";  // default MySQL username (modify if needed)
    $password_db = "";      // default MySQL password (modify if needed)
    $dbname = "test";       // database name

    // Create connection
    $conn = mysqli_connect($servername, $username_db, $password_db, $dbname) or die("Cannot connect to the database: " . mysqli_connect_error());
    // Fetch all reservation data
    $query = "SELECT table_no, status, partysize FROM reserve";
    $result = mysqli_query($conn, $query);

    // Initialize an empty array to store table statuses and party sizes
    $tableStatus = [];

    if ($result) {
        // Loop through the results and build an associative array for table statuses
        while ($row = mysqli_fetch_assoc($result)) {
            $tableStatus[$row['table_no']] = [
                'status' => $row['status'],
                'partysize' => (int)$row['partysize']  // cast to int for numerical operations
            ];
        }
    }

    // Fetch reservations for the logged-in user
    $query2 = "SELECT * FROM reserve WHERE username = '$uid'";
    $result2 = mysqli_query($conn, $query2);
    $reservations = [];

    if ($result2) {
        while ($row = mysqli_fetch_assoc($result2)) {
            $reservations[] = $row;
        }
    }
    // Close the connection
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Layout</title>
    <link rel="stylesheet" href="./style.css?v=1.1">
    <script src="./script.js"></script>
    <style>
        /* General container for tables */
        body{
            background: url('backimg.jpg');
        }
        .table-layout-container {
            display: flex;
            flex-wrap: wrap; 
            gap: 70px; 
            justify-content: space-around;
        }

        .table-layout {
            display: inline-block;
        }
        #date-reserve{
            width: 100%;
            font-size: 16px;
        }
        #time-reserve{
            width: 100%;
            font-size: 16px;
        }
        .status-red {
            background-color: red;
            color: white;
        }
        .status-yellow {
            background-color: yellow;
        }
        .status-available {
            background-color: green;
            color: white;
        }
        .chair-occupied {
            background-color: rgba(255, 0, 0, 0.5);
        }
        .chair-available {
            background: rgba(117, 117, 117, 0.596);
        }
        .chair-warning {
            background-color: rgba(255, 255, 0, 0.5);
        }
        .disable {
            cursor: default;
            pointer-events: none;  /* Prevents user interaction */
            opacity: 0.6;
        }
        table{
            font-size: 12px;
        }
        .user-reservations{
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="./Images/logo_reserve.png" alt="Logo" style="height: 40px; width: 300px">
            </div>
            <div class="search">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search-heart" viewBox="0 0 16 16">
                    <path d="M6.5 4.482c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018"/>
                    <path d="M13 6.5a6.47 6.47 0 0 1-1.258 3.844q.06.044.115.098l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1-.1-.115h.002A6.5 6.5 0 1 1 13 6.5M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11"/>
                </svg>
                <input type="text" placeholder="Search for a food">
            </div>
            <div class="profile">
                <img src="./Images/profile.png" alt="Profile">
            </div>
        </header>
        
        <main>
            <div class="table-layout-container">
                <?php
                    $tables = ['T01', 'T02', 'T03', 'T04', 'T05', 'T06', 'T07', 'T08', 'T09', 'T10'];
                    $tableChairCount = [
                        'T01' => 8, 'T02' => 4, 'T03' => 4, 'T04' => 4,
                        'T05' => 4, 'T06' => 4, 'T07' => 4, 'T08' => 8,
                        'T09' => 8, 'T10' => 8
                    ];

                    foreach ($tables as $table_no) {
                        // Determine if table is occupied
                        if(array_key_exists($table_no, $tableStatus) && $tableStatus[$table_no]['status'] === 'Yes'){
                            $chairClass = 'chair-occupied';
                        }else if(array_key_exists($table_no, $tableStatus) && ($tableStatus[$table_no]['status'] === '' || $tableStatus[$table_no]['status'] === 'No')){
                            $chairClass = 'chair-warning';
                        }else{
                            $chairClass = 'chair-available';
                        }

                        // Get the number of chairs for this table
                        $chairCount = $tableChairCount[$table_no];

                        // Output table div
                        echo "<div class='table-layout'>";
                        echo "<div class='table " . ($chairCount == 8 ? 'eight-chairs' : 'four-chairs') . "' id='$table_no'>";

                        // Output chairs based on the number of chairs for this table
                        if ($chairCount == 4) {
                            echo "<div class='chair top $chairClass'></div>";
                            echo "<div class='chair bottom $chairClass'></div>";
                            echo "<div class='chair left $chairClass'></div>";
                            echo "<div class='chair right $chairClass'></div>";
                        } else {
                            echo "<div class='chair top $chairClass'></div>";
                            echo "<div class='chair top $chairClass'></div>";
                            echo "<div class='chair right $chairClass'></div>";
                            echo "<div class='chair right $chairClass'></div>";
                            echo "<div class='chair bottom $chairClass'></div>";
                            echo "<div class='chair bottom $chairClass'></div>";
                            echo "<div class='chair left $chairClass'></div>";
                            echo "<div class='chair left $chairClass'></div>";
                        }

                        // Output table number
                        echo "<div class='table-number'>$table_no</div>";
                        echo "</div>"; // Close table div
                        echo "</div>"; // Close table-layout div
                    }
                ?>
            </div>
        </main>

        <aside class="table-panel">
            <h3>Table</h3>
            <p>Order #102</p>
            <div class="table-info">
                <?php
                // Array of table numbers to check
                $tables = ['T01', 'T02', 'T03', 'T04', 'T05', 'T06', 'T07', 'T08', 'T09', 'T10'];

                foreach ($tables as $table_no) {
                    // Check the status for each table number
                    if (array_key_exists($table_no, $tableStatus)) {
                        // Table exists in the reserve table
                        if ($tableStatus[$table_no]['status'] === 'Yes') {
                            $statusClass = 'status-red disable';  // reserved, background red
                            $disabled = 'disabled';
                        } else if($tableStatus[$table_no]['status'] === ''){
                            $statusClass = 'status-yellow disable';  // not reserved, background yellow
                            $disabled = 'disabled';
                        } else if($tableStatus[$table_no]['status'] === 'Cancel' || $tableStatus[$table_no]['status'] === 'No'){
                            $statusClass = 'status-available';
                        }
                
                    } else{
                        // Table does not exist, status is No
                        $statusClass = 'status-available';  // table does not exist, background red
                        $disabled = '';
                    }
                    // Output the table button with the dynamic class
                    echo "<button id='$table_no' class='table-button $statusClass' $disabled onclick='toggleDropdown(\"$table_no\")'>$table_no</button>";
                }
                ?>
            </div>

            <form action="ReserveTable.php" method="post">
                <div class="dropdown" id="person-dropdown">
                    <label>Reserve for <span id="selected-table">Table</span>:</label>
                    <br><br>
                    <input type="hidden" id="selected-table-input" name="table-name" value="">
                    <input type="hidden" name="username" value="<?php echo $uid; ?>">
                    <label>Enter Number of Persons:</label><br><br>
                    <input type="number" id="num-persons" name="num-persons"><br><br>
                    <label>Date of Reservation:</label><br><br>
                    <input type="date" id="date-reserve" name="date-reserve"><br><br>
                    <label>Time of Reservation:</label><br><br>
                    <input type="time" id="time-reserve" name="time-reserve">
                </div>
                <input type="submit" class="place-order" name="submit" value="Reserve Table">
            </form>
        </aside>

        <div class="user-reservations">
                <h4>Your Reservations</h4>
                
                <?php
                    if (empty($reservations)) {
                        echo "Not Any Reservations Found By You!!";
                    } else {
                        ?>
                        <table border=1 height=50% width=100%>
                        <tr>
                            <th>Table No</th>
                            <th>Party Size</th>
                            <th>Date Reserved</th>
                            <th>Time Reserved</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        <?php
                            foreach ($reservations as $reservation) {
                                echo "<tr id='row-{$reservation['username']}'>";
                                echo "<td id='table_no-{$reservation['username']}'>{$reservation['table_no']}</td>";
                                echo "<td id='date-{$reservation['username']}'>{$reservation['date']}</td>";
                                echo "<td id='time-{$reservation['username']}'>{$reservation['time']}</td>";
                                echo "<td id='party_size-{$reservation['username']}'>{$reservation['partysize']}</td>";
                                if($reservation['status'] == ''){
                                    $reservation['status'] = 'Waiting';
                                }
                                echo "<td id='status-{$reservation['username']}'>{$reservation['status']}</td>";
                                echo "<td>";
                                echo "<button onclick=\"deleteReservation('{$reservation['username']}')\">Cancel</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        ?>
                        </table>
                    <?php  }  ?>
                
        </div>            
    </div>
</body>
</html>
