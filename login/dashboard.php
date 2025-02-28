<?php
require('connection.php'); // Include the database connection

session_start(); // Start the session to access session variables

// If the user is not logged in, redirect them to the login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page
    exit();
}

// Fetch user details from the database
$user_id = $_SESSION['user_id'];
$user_query = "SELECT * FROM registered_users WHERE id = '$user_id'";
$user_result = mysqli_query($con, $user_query);
$user = mysqli_fetch_assoc($user_result);

// Handle course enrollment or other dashboard functionalities
// (Add code here if you want to show user's enrolled courses, etc.)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        header { background-color: #333; color: white; padding: 10px 0; text-align: center; }
        .container { width: 80%; margin: 0 auto; padding: 20px; }
        .dashboard { background-color: white; padding: 20px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
        .dashboard h2 { margin-top: 0; }
        .logout-button { background-color: #d9534f; color: white; padding: 10px 20px; border: none; cursor: pointer; margin-top: 20px; }
        .logout-button:hover { background-color: #c9302c; }
        footer { background-color: #333; color: white; text-align: center; padding: 10px 0; margin-top: 20px; }
    </style>
</head>
<body>

<header>
    <h1>Welcome to Your Dashboard, <?php echo htmlspecialchars($user['username']); ?></h1>
</header>

<div class="container">
    <div class="dashboard">
        <h2>Dashboard Overview</h2>
        <p>Welcome back, <?php echo htmlspecialchars($user['fullname']); ?>! You are logged in.</p>
        
        <!-- Example of displaying user details -->
        <h3>Your Information:</h3>
        <ul>
            <li>Full Name: <?php echo htmlspecialchars($user['fullname']); ?></li>
            <li>Username: <?php echo htmlspecialchars($user['username']); ?></li>
            <li>Email: <?php echo htmlspecialchars($user['email']); ?></li>
        </ul>

        <!-- Add buttons or links for user-specific actions like courses, profile, etc. -->
        <p><a href="profile.php">Go to your profile</a></p>
        <p><a href="courses.php">View your courses</a></p>

        <!-- Logout button -->
        <form method="POST">
            <button type="submit" name="logout" class="logout-button">Logout</button>
        </form>
    </div>
</div>

<footer>
    <p>&copy; 2024 Career Express. All rights reserved.</p>
</footer>

</body>
</html>

<?php
// Logout functionality to destroy the session and logout the user
if (isset($_POST['logout'])) {
    session_destroy(); // Destroy the session to log out the user
    header('Location: index.php'); // Redirect to homepage after logout
    exit(); // Ensure no further code is executed
}
?>
