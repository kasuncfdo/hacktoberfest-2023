<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}

// Include the database connection configuration
require_once 'db_config.php';

// Check if the 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Fetch the post from the database based on the provided 'id'
    $sql = "SELECT * FROM posts WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $post_id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 1) {
            $post = mysqli_fetch_assoc($result);
        } else {
            // Redirect to a 404 page or any error page if the post with the given 'id' is not found
            header("Location: error_page.php");
            exit();
        }
    } else {
        // Redirect to a 500 page or any error page if the query preparation fails
        header("Location: error_page.php");
        exit();
    }
} else {
    // Redirect to a 404 page or any error page if the 'id' parameter is missing
    header("Location: error_page.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $published_at_date = $_POST['published_at_date'];
    $published_at_time = $_POST['published_at_time'];

    // Combine the date and time into a single datetime format (Y-m-d H:i:s)
    $published_at = $published_at_date . ' ' . $published_at_time;

    // Update the post in the database
    $sql = "UPDATE posts SET title = ?, content = ?, published_at = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssi", $title, $content, $published_at, $post_id);
        mysqli_stmt_execute($stmt);
    }

    // Redirect back to the admin dashboard after updating the post
    header("Location: admin_dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <link rel="stylesheet" type="text/css" href="./css/edit.css">
    <style>
        body , * {

	font-family: 'Product Sans',  -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif !important;
    -webkit-font-smoothing: antialiased !important;
    -moz-osx-font-smoothing: grayscale !important;
    text-rendering: optimizeLegibility !important;
    }
    
    p {
    font-family: 'Product Sans',  serif !important;
    }  
    </style>
    <style>
                            @import url('https://fonts.cdnfonts.com/css/product-sans');
</style>
                
</head>
<body>
    <h1>Edit Post</h1>
    <form action="" method="post">
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>

        <label for="content">Content:</label>
        <textarea name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>

        <!-- Date and Time selectors -->
        <label for="published_at_date">Date:</label>
        <input type="date" name="published_at_date" value="<?php echo date('Y-m-d', strtotime($post['published_at'])); ?>" required>

        <label for="published_at_time">Time:</label>
        <input type="time" name="published_at_time" value="<?php echo date('H:i', strtotime($post['published_at'])); ?>" required>

        <input type="submit" value="Update Post">
    </form>
</body>
</html>
