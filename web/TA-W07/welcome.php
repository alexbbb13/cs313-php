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
<br>
<?php
   require 'session.php';
   
    function redirectToLogin() {
         $newPage = "login.php";
         header("Location: $newPage");
         die();    
    }

      function printUser($username) {
        echo '<h2>Welcome, '.$username.'</h2>';
    }

    if (getSessionUser() == null) {
        redirectToLogin();
    } else {
        printUser(getSessionUserName());
    }
?>
</body>
</html>