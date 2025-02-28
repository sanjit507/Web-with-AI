<?php
session_start();
require('connection.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php'); // Redirect to login if not logged in
    exit();
}

// Fetch user data from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM registered_users WHERE id = '$user_id'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);

// Handle profile update
if (isset($_POST['update_profile'])) {
    $education = mysqli_real_escape_string($con, $_POST['education']);
    $favorite_subjects = mysqli_real_escape_string($con, implode(", ", $_POST['favorite_subjects'])); // Store as comma-separated string

    // Handle profile picture upload
    if (isset($_FILES['profile_picture'])) {
        $profile_picture = $_FILES['profile_picture'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($profile_picture["name"]);
        
        // Upload the profile picture
        if (move_uploaded_file($profile_picture["tmp_name"], $target_file)) {
            // Update profile in the database
            $query = "UPDATE registered_users SET education = '$education', favorite_subjects = '$favorite_subjects', profile_picture = '$target_file' WHERE id = '$user_id'";
            if (mysqli_query($con, $query)) {
                $_SESSION['success'] = "Profile updated successfully!";
                header('Location: profile_setup.php');
                exit();
            } else {
                $_SESSION['error'] = "Error updating profile!";
            }
        } else {
            $_SESSION['error'] = "Error uploading profile picture!";
        }
    } else {
        // If no profile picture is uploaded, just update education and subjects
        $query = "UPDATE registered_users SET education = '$education', favorite_subjects = '$favorite_subjects' WHERE id = '$user_id'";
        if (mysqli_query($con, $query)) {
            $_SESSION['success'] = "Profile updated successfully!";
            header('Location: profile_setup.php');
            exit();
        } else {
            $_SESSION['error'] = "Error updating profile!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Setup</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  
  <header>
    <h2>Profile Setup</h2>
    <nav>
      <a href="index.php">Home</a>
    </nav>
  </header>

  <!-- Display Success/Error messages -->
  <?php if (isset($_SESSION['error'])): ?>
    <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
  <?php endif; ?>
  <?php if (isset($_SESSION['success'])): ?>
    <p style="color: green;"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data">
    <div>
      <label for="education">Education</label>
      <input type="text" name="education" id="education" value="<?php echo $user['education']; ?>" required>
    </div>
    
    <div>
      <label for="favorite_subjects">Favorite Subjects (hold ctrl or cmd to select multiple)</label>
      <select name="favorite_subjects[]" id="favorite_subjects" multiple required>
        <option value="AI & ML" <?php echo in_array('AI & ML', explode(', ', $user['favorite_subjects'])) ? 'selected' : ''; ?>>AI & ML</option>
        <option value="Cyber Security" <?php echo in_array('Cyber Security', explode(', ', $user['favorite_subjects'])) ? 'selected' : ''; ?>>Cyber Security</option>
        <option value="Software Engineering" <?php echo in_array('Software Engineering', explode(', ', $user['favorite_subjects'])) ? 'selected' : ''; ?>>Software Engineering</option>
        <option value="Data Science" <?php echo in_array('Data Science', explode(', ', $user['favorite_subjects'])) ? 'selected' : ''; ?>>Data Science</option>
        <!-- Add more subjects as needed -->
      </select>
    </div>

    <div>
      <label for="profile_picture">Profile Picture</label>
      <input type="file" name="profile_picture" id="profile_picture">
      <?php if ($user['profile_picture']): ?>
        <img src="<?php echo $user['profile_picture']; ?>" alt="Profile Picture" width="100">
      <?php endif; ?>
    </div>

    <button type="submit" name="update_profile">Update Profile</button>
  </form>

</body>
</html>
