<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.html");
    exit();
}
$user = $_SESSION['username'];
$branch = $_SESSION['branch'];

// Database connection
$host = 'localhost'; // Database host
$username = 'root'; // Username
$password = ''; // Password (empty if none)
$database = 'test'; // Your database name
$table = 'reserve'; // The table you want to fetch data from

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <link rel="stylesheet" href="manager.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <!-- Sidebar and other content -->
        <aside class="sidebar">
            <div class="logo">
                <h1>Cannbals' Paradise</h1>
            </div>
            <div class="user-info">
                <!-- Display the logged-in user's name and branch -->
                <p><strong>Name:</strong> <?php echo htmlspecialchars($user); ?></p>
                <p><strong>Branch:</strong> <?php echo htmlspecialchars($branch); ?></p>
            </div>
            <nav class="menu">
                <ul>
                    <li>Dashboard</li>
                </ul>
            </nav>
        </aside>

        <!-- Main content area -->
        <main class="main-content">
            <!-- Search and Add New Item -->
        
            <header class="top-bar">
                
                <input type="text" placeholder="Search Category or Menu">
                <button class="add-new">+ Add New Item</button>
            </header>
            <!-- Orders Table -->
            <section class="order-list">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Table No.</th>
                            <th>Party Size</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // SQL query to fetch reservations
                        $sql = "SELECT username, table_no, partysize, date, status FROM $table";
                        $result = $conn->query($sql);

                        if ($result === false) {
                            die("Error in SQL query: " . $conn->error);
                        }

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr data-username='" . $row['username'] . "' data-table_no='" . $row['table_no'] . "' data-date='" . $row['date'] . "'>";
                                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['table_no']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['partysize']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['date']) . "</td>";

                                // Show buttons if status is not set, otherwise show status (Yes/No)
                                if (empty($row['status'])) {
                                    echo "<td>
                                        <button class='yes-btn' data-username='" . $row['username'] . "' data-table_no='" . $row['table_no'] . "' data-date='" . $row['date'] . "'>Yes</button>
                                        <button class='no-btn' data-username='" . $row['username'] . "' data-table_no='" . $row['table_no'] . "' data-date='" . $row['date'] . "'>No</button>
                                    </td>";
                                } else {
                                    echo "<td>" . ($row['status'] == 'Yes' ? 'Yes' : 'No') . "</td>";
                                }

                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No records found.</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </section>
            </tbody>
                    </table>
                </section>
    
                <!-- Customer and Order Summary -->
                <section class="summary">
                    <!-- Customer Details -->
                    <div class="customer-details">
                        <h3>Customer's Details</h3>
                        <p><strong>Full Name:</strong> Marija Uddin Hima</p>
                        <p><strong>ID:</strong> 0038900022</p>
                        <p><strong>Email:</strong> example@gmail.com</p>
                        <p><strong>Phone:</strong> +123456789</p>
                    </div>
    
                    <!-- Membership Card -->
                    <div class="membership-card">
                        <h3>Membership Card</h3>
                        <p><strong>Card Code:</strong> 30506912345</p>
                        <p><strong>Membership:</strong> Gold</p>
                    </div>
    
                    <!-- New Order Bill -->
                    <div class="new-order">
                        <h3>New Order Bill</h3>
                        <ul>
                            <li>Double Cheese Burger (1 pc) - $3.00</li>
                            <li>Cupcake (2 pc) - $2.00</li>
                            <li>Double Cheese Burger (2 pc) - $4.00</li>
                        </ul>
                        <p><strong>Sub Total:</strong> $9.00</p>
                        <p><strong>VAT:</strong> $1.00</p>
                        <p><strong>Total:</strong> $10.00</p>
                    </div>
                </section>
            </main>
        </div>
        </main>
    </div>

    <script>
    // Function to handle Yes button click
    $(document).on('click', '.yes-btn', function() {
        var username = $(this).data('username');
        var table_no = $(this).data('table_no');
        var date = $(this).data('date');
        console.log("Yes button clicked for username: " + username);  // Debugging
        updateStatus(username, table_no, date, 'Yes');
    });

    // Function to handle No button click
    $(document).on('click', '.no-btn', function() {
        var username = $(this).data('username');
        var table_no = $(this).data('table_no');
        var date = $(this).data('date');
        console.log("No button clicked for username: " + username);  // Debugging
        updateStatus(username, table_no, date, 'No');
    });

    // Function to update the status via AJAX and update the UI
    function updateStatus(username, table_no, date, status) {
        $.ajax({
            url: 'update_status.php',
            type: 'POST',
            data: {
                username: username,
                table_no: table_no,
                date: date,
                status: status
            },
            success: function(response) {
                console.log('Response from server: ' + response);  // Debugging
                if (response == 'success') {
                    var row = $("tr[data-username='" + username + "'][data-table_no='" + table_no + "'][data-date='" + date + "']");
                    var actionCell = row.find('td:last');
                    actionCell.html(status === 'Yes' ? 'Yes' : 'No');
                } else {
                    console.log('Failed to update status: ' + response);  // Debugging
                }
            },
            error: function(error) {
                console.log("Error during AJAX call: ", error);  // Debugging
            }
        });
    }
</script>

</body>
</html>

<!-- <?php
$conn->close();
?> -->
