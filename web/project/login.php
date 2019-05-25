<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<?php
   require 'db.php';
   require 'session.php';


    function printNoUser() {
        echo '<h2>Login</h2>
        <br>
        <form action="./login.php" method="POST">
        E-mail:
        <input name="login" type="email"><br><br>
        Password:
        <input name="password" type="text">
        <br><br>
        <input type="submit">
        </form>';
    }

      function printUser($username) {
        echo '<h2>Welcome, $username</h2>';
    }
   
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login']) && isset($_POST['password'])){
        // retrieve the form data by using the element's name attributes value as key
        $login = $_POST['login'];
        $password = $_POST['password'];
        $db = getDb();
        $users = selectByLoginPassword($db, $login, $password);//listAll($db); //
    }
    var_export($users);
    if(sizeof($users) == 0) {
            //User not found
            printNoUser();
    } else if (sizeof($users) == 1) {
            // user is found, storing the user Id into session
            foreach($users as $r) 
                {
                    sessionSetUser($r['id']);
                    printUser($r['username']);
                }    
    } else {
        // multiple users, 
        echo '<h2>Error</h2>';
    }
        
?>
</body>
</html>