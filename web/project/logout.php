<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel = "stylesheet"
          type = "text/css"
          href = "style.css" />
</head>
<body>
<?php
require 'navbar.php';
?>  
<br>
<?php
    setSessionUser(null);
    $newPage = "login.php";
    header("Location: $newPage");
die();
?>
</body>
</html>