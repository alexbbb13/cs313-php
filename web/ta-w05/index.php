<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Team Work W 05</title>
</head>
<body>
<h2>Scripture resources</h2>
<br>
<form action="./index.php" method="GET">
  Enter book:
  <input name="book" type="text">
  <br><br>
  <input type="submit">
</form>

<?php
require 'db.php';
//Local or Heroku
$db = getDb();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // retrieve the form data by using the element's name attributes value as key
           if (isset($_GET['book']))
				{
				    $book = $_GET['book'];
					 $allRows = selectByBook($db, $book);					    
				} else {
					echo "<p>no book!</p>";
				    $allRows = selectAll($db);
				    var_dump($allRows);					    
				}
				foreach($allRows as $r) 
				{
					echo '<span class="text_title">'.$r['book']." ".$r['chapter'].":".$r['verse'].'</span>';
					echo ' <span class="text_content">'.$r['content'].'</span>';
					echo '<br>';
				}

    } else {
    	echo "<p>no request method!</p>";
    }
?>
</body>
</html>