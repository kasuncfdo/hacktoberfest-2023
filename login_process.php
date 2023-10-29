<?php
session_start();

// Include the database connection configuration
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user inputs from the login form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // TODO: Implement proper validation and sanitization for the input fields

    // Retrieve the admin credentials from the database
    $sql = "SELECT * FROM admins WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $admin = mysqli_fetch_assoc($result);
        $hashedPassword = $admin['password'];

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, set a session variable to indicate successful login
            $_SESSION['admin_username'] = $admin['username'];

            // Redirect to the admin dashboard
            header("Location: admin_dashboard.php");
            exit();
        }
    }

    // If login fails, redirect back to the login page with an error message
    header("Location: admin_login.php?login_error=1");
    exit();
} else {
    // Redirect back to the login page if the request method is not POST
    header("Location: admin_login.php");
    exit();
}
