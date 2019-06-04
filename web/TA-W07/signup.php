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
        echo '<h2>Signup</h2>
        <br>
        <form action="./signup.php" method="POST">
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

    function insertUser($db, $login, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        insertUser($db, $login, $password);
    }


    function redirectToWelcome() {
         $newPage = "welcome.php";
         header("Location: $newPage");
         die();    
    }
   
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login']) && isset($_POST['password'])){
        // retrieve the form data by using the element's name attributes value as key
        $login = $_POST['login'];
        $password = $_POST['password'];
        $db = getDb();
        $users = selectByLogin($db, $login);
        //$users = selectByLoginPassword($db, $login, $password);
        $countUsers =count($users); 
        if($countUsers == 0) {
                //User not found
                $user_id = insertUser($db, $login, $password);
                setSessionUser($user_id, $login);
                redirectToWelcome();
        } else {
            // multiple users with same login not allowed, 
            echo '<h2>Error</h2>';
        }
    } else {
        //Get or no login/ password info
        printNoUser();
    }
?>
</body>
</html>