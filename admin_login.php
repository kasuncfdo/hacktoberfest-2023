<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="./css/login.css">
    <style>
    body , * {

	font-family: 'Product Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif !important;
    -webkit-font-smoothing: antialiased !important;
    -moz-osx-font-smoothing: grayscale !important;
    text-rendering: optimizeLegibility !important;
    }
    
    p {
    font-family: 'Product Sans',  'Noto Serif Sinhala', serif !important;
    }  
    body{
            background-image: linear-gradient(#f8fdfd, #f3f1fb) !important;
    }
    
    form {
  background-color: #fff;
  padding: 40px;
  /width: 20rem;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
    
        input[type="submit"] {
  background-color: black;
  color: #fff;
  padding: 10px 20px;
  font-size: 16px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
    </style>
    <style>
                            @import url('https://fonts.cdnfonts.com/css/product-sans');
</style>
                
</head>
<body>
    <div class="form-wrapper">
        <div class="container">
            <form action="login_process.php" method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" required>

                <label for="password">Password:</label>
                <input type="password" name="password" required>

                <input type="submit" value="Login">
            </form>
        </div>
    </div>
</body>
</html>
