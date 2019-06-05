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
        var_dump($password);
        echo '<br>';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        echo 'password='.$password.', hash = '.$hashedPassword.'<br>';
        var_dump($hashedPassword);
        echo '<br>';
        $users = selectByLoginPassword($db, $login, $hashedPassword);//listAll($db); //
        var_dump($users);
        $countUsers =count($users); 
        if($countUsers == 0) {
                //User not found
                printNoUser();
        } else if ($countUsers == 1) {
                // user is found, storing the user Id into session
                $r = users[0];
                setSessionUser($r['id'], $r['login']);
                printUser($r['username']);
                $newPage = "welcome.php";
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