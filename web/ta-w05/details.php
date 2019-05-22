<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Team Work W 05 details</title>
</head>
<body>
<h2>Scripture details</h2>
<br>

<?php
   require 'db.php';
   $db = getDb();
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // retrieve the form data by using the element's name attributes value as key
        $scripture_id = $_GET['id'];
        var_dump($db);
        $allRows = selectById($db);
        foreach($allRows as $r) 
        {
                    echo '<b>'.$r['book']." ".$r['chapter'].":".$r['verse'].'</b>';
                    echo ' <span class="text_content">'.$r['content'].'</span><br>';
                    echo '<br>';
        }
    }
?>
</body>
</html>