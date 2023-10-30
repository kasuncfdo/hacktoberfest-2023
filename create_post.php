<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post</title>
    <link rel="stylesheet" type="text/css" href="./css/createpost.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Sinhala:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
    body , * {

	font-family: 'Product Sans',  'Noto Serif Sinhala', -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif !important;
    -webkit-font-smoothing: antialiased !important;
    -moz-osx-font-smoothing: grayscale !important;
    text-rendering: optimizeLegibility !important;
    }
    
    p {
    font-family: 'Product Sans',  'Noto Serif Sinhala', serif !important;
    }  
</style>

<style>
                            @import url('https://fonts.cdnfonts.com/css/product-sans');
</style>
                
</head>
<body>
    <div class="container">
        <h1>Create New Post</h1>
        <form action="create_post_process.php" method="post">
            <label for="title">Title:</label>
            <input type="text" name="title" required>
            
            <label for="content">Content:</label>
            <textarea name="content" required></textarea>
            
            <input type="submit" value="Publish">
        </form>
    </div>
