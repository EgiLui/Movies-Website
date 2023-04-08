<?php
// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movies";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve records from booking table
$sql = "SELECT * FROM booking";
$result = mysqli_query($conn, $sql);

// Display records in table format
if (mysqli_num_rows($result) > 0) {
    echo "<table class='futuristic-table'>";
    echo "<thead><tr><th>Movie</th><th>Booking Date/Time</th><th>Cinema</th></tr></thead>";
    echo "<tbody>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["movie"] . "</td>";
        echo "<td>" . $row["bookingDateTime"] . "</td>";
        echo "<td>" . $row["cinema"] . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "No movies have been booked yet.";
    echo "<a href='index.php'>&lt;&lt; Back to home</a>"; // Add "Back" button
}

// Close MySQL connection
mysqli_close($conn);
?>

<style>
.futuristic-table {
  border-collapse: collapse;
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
  font-size: 18px;
  font-weight: bold;
  text-align: center;
}

.futuristic-table th {
  background-color: #00ffff;
  color: #000;
  padding: 15px;
  text-transform: uppercase;
}

.futuristic-table td {
  background-color: #000;
  color: #fff;
  padding: 10px;
}

.futuristic-table tr:nth-child(even) {
  background-color: #444;
}

.futuristic-table tr:hover {
  background-color: #666;
}
</style>
