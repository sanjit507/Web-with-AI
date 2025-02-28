<?php
$con = mysqli_connect("127.0.0.1", "root", "sanjit123", "testing", 3307);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Run a simple query to test the connection
$result = mysqli_query($con, "SELECT DATABASE()");

if ($result) {
    $db_name = mysqli_fetch_assoc($result);
    echo "Connected to database: " . $db_name['DATABASE()'];
} else {
    echo "Error running query: " . mysqli_error($con);
}
?>
