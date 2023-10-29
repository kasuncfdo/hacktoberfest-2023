<?php
session_start();

// database connection configuration
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in as an admin
    if (!isset($_SESSION['admin_username'])) {
        header("Location: admin_login.php");
        exit();
    }

    // Retrieve post data from the form
    $title = $_POST['title'];
    $content = $_POST['content'];


    // Prepare the insert query to save the new post into the database
    $sql = "INSERT INTO posts (title, content) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind parameters and execute the query
        mysqli_stmt_bind_param($stmt, "ss", $title, $content);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Post creation successful, redirect to the admin dashboard
            header("Location: admin_dashboard.php");
            exit();
        } else {
            // If the post creation fails, redirect back to the create post page with an error message
            header("Location: create_post.php?create_error=1");
            exit();
        }
    }
} else {
    // Redirect back to the create post page if the request method is not POST
    header("Location: create_post.php");
    exit();
}
