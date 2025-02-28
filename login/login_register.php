<?php
require('connection.php'); // Include the database connection

session_start(); // Start the session to access session variables

// Error reporting (for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle registration
if (isset($_POST['register'])) {
    // Get form data and sanitize it
    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    
    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email or username already exists
    $check_query = "SELECT * FROM registered_users WHERE email = '$email' OR username = '$username'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // User already exists
        $_SESSION['error'] = 'Email or Username already exists.';
        header('Location: index.php');
        exit();
    } else {
        // Insert new user into the database
        $insert_query = "INSERT INTO registered_users (fullname, username, email, password) VALUES ('$fullname', '$username', '$email', '$hashed_password')";
        
        if (mysqli_query($con, $insert_query)) {
            // Registration successful
            $_SESSION['success'] = 'Registration successful. You can now log in.';
            header('Location: index.php');
            exit();
        } else {
            // Error during registration
            $_SESSION['error'] = 'Error occurred during registration. Please try again later.';
            header('Location: index.php');
            exit();
        }
    }
}

// Handle login
if (isset($_POST['login'])) {
    $email_username = mysqli_real_escape_string($con, $_POST['email_username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Check if the email/username exists in the database
    $login_query = "SELECT * FROM registered_users WHERE username = '$email_username' OR email = '$email_username'";
    $result = mysqli_query($con, $login_query);

    if (mysqli_num_rows($result) > 0) {
        // Fetch user data from the database
        $user = mysqli_fetch_assoc($result);

        // Verify the entered password with the hashed password stored in the database
        if (password_verify($password, $user['password'])) {
            // Successful login
            $_SESSION['user_id'] = $user['id']; // Store user ID in session
            $_SESSION['username'] = $user['username']; // Store username in session
            header('Location: index.php'); // Redirect to homepage after login
            exit();
        } else {
            // Incorrect password
            $_SESSION['error'] = 'Incorrect password. Please try again.';
            header('Location: index.php');
            exit();
        }
    } else {
        // User not found
        $_SESSION['error'] = 'User not found. Please register first.';
        header('Location: index.php');
        exit();
    }
}

// Handle logout
if (isset($_POST['logout'])) {
    session_destroy(); // Destroy the session to log out the user
    header('Location: index.php'); // Redirect to homepage after logout
    exit(); // Ensure no further code is executed
}
?>
