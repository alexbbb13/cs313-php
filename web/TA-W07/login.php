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
   require 'db.php';
   require 'session.php';
   
    function printNoUser() {
        echo '<h2>Login</h2>
        <br>
        <form action="./login.php" method="POST">
        E-mail:
        <input name="login" type="text"><br><br>
        Password:
        <input name="password" type="text">
        <br><br>
        <input type="submit">
        </form>';
    }

      function printUser($username) {
        echo '<h2>Welcome, '.$username.'</h2>';
    }
   
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login']) && isset($_POST['password'])){
        // retrieve the form data by using the element's name attributes value as key
        $login = $_POST['login'];
        $password = $_POST['password'];
        $db = getDb();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $users = selectByLoginPassword($db, $login, $hashedPassword);//listAll($db); //
        $countUsers =count($users); 
        if($countUsers == 0) {
                //User not found
                printNoUser();
        } else if ($countUsers == 1) {
                // user is found, storing the user Id into session
                $r = users[0];
                setSessionUser($r['id'], $r['login']);
                printUser($r['username']);
                $newPage = "freelance.php?my=true";
                header("Location: $newPage");
                die();    
        } else {
            // multiple users, 
            echo '<h2>Error</h2>';
        }
    } else {
        //Get or no login/ password info
        printNoUser();
    }
?>
</body>
</html>