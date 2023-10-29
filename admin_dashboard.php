<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}

// Include the database connection configuration
require_once 'db_config.php';

// Function to delete a post by ID
function deletePost($conn, $post_id) {
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $post_id);
        mysqli_stmt_execute($stmt);
    }
}

// Check if the 'action' parameter is present in the URL
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $post_id = $_GET['id'];

    if ($action === 'delete') {
        // Delete the post and redirect back to the dashboard
        deletePost($conn, $post_id);
        header("Location: admin_dashboard.php");
        exit();
    } elseif ($action === 'edit') {
        // Redirect to the edit post page
        header("Location: edit_post.php?id=$post_id");
        exit();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="./css/edit.css">
    <link rel="stylesheet" type="text/css" href="./css/inherit.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Sinhala:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        .wave {
  animation-name: wave-animation; /* Refers to the name of your @keyframes element below */
  animation-duration: 2.5s; /* Change to speed up or slow down */
  animation-iteration-count: infinite; /* Never stop waving :) */
  transform-origin: 70% 70%; /* Pivot around the bottom-left palm */
  display: inline-block;
  font-size: 2rem ;
}

@keyframes wave-animation {
  0% {
    transform: rotate(0deg);
  }
  10% {
    transform: rotate(14deg);
  } /* The following five values can be played with to make the waving more or less extreme */
  20% {
    transform: rotate(-8deg);
  }
  30% {
    transform: rotate(14deg);
  }
  40% {
    transform: rotate(-4deg);
  }
  50% {
    transform: rotate(10deg);
  }
  60% {
    transform: rotate(0deg);
  } /* Reset for the last half to pause */
  100% {
    transform: rotate(0deg);
  }
}



/* Media query for mobile devices (up to 767px width) */
@media (max-width: 767px) {
  .wave {
    font-size: 3.5rem; /* Apply font size only on mobile devices */
  }
}


.delete-post {
    
        background: #ff0000;
    border-radius: 99rem;
    padding: 8px 25px 8px 25px;
    text-decoration: none;
    font-size: 15px;
    color: aliceblue;
}

.edit-post {
        background: #000000;
    border-radius: 99rem;
 padding: 8px 25px 8px 25px;
    text-decoration: none;
    color: aliceblue;
    font-size: 15px;
}

.create-post {
 
    margin: 25px;
    background: #000000;
    color: aliceblue;
    border-radius: 0.5rem;
    padding: 9px 15px 9px 15px;
    text-decoration: none;
    font-size: 12px;
    
    /font-size: 20px !important;
    /position: fixed !important;
    /bottom: 30px !important;
    /left: 30rem !important;
    /right: 30rem !important;
    /display: flex !important;
    /align-content: center;
    /justify-content: center;
    /align-items: center;
    /z-index: 99 !important;
}

body , * {

	font-family: 'Product Sans',  'Stick No Bills', -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif !important;
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
                <style>
  @import url('https://fonts.googleapis.com/css2?family=Stick+No+Bills:wght@300&display=swap');
</style>
</head>
<body>
    <h1 style="margin: 25px !important;">Welcome <span class="wave">👋</span>, <?php echo $_SESSION['admin_username']; ?>!</h1>

    <a class="create-post" href="create_post.php">Create New Post</a>
    <br>

    <?php
    // Fetch posts from the database
    $sql = "SELECT * FROM posts ORDER BY published_at DESC";
    $result = mysqli_query($conn, $sql);

    // Check if there are posts to display
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="post-card">
                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                <p class="published-at">Published on: <?php echo htmlspecialchars($row['published_at']); ?></p>
                <p style="    color: #8f8f8f;"><?php echo substr(htmlspecialchars($row['content']), 0, 200) . '...'; ?></p>
                <br>
                <div class="post-actions">
                    <a class="edit-post" href="admin_dashboard.php?action=edit&id=<?php echo $row['id']; ?>">Edit</a>
                    <a class="delete-post" href="admin_dashboard.php?action=delete&id=<?php echo $row['id']; ?>">Delete</a>
                </div>
            </div>
            <hr style="
    margin: 25px;
    backdrop-filter: opacity(0.5);    border-color: #ffffff91;
">
            <?php
        }
    } else {
        echo "<p>No posts found.</p>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

</body>
</html>
