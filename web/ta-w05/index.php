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
				    $allRows = selectAll($db);
				 }
				foreach($allRows as $r) 
				{
					echo '<b>'.$r['book']." ".$r['chapter'].":".$r['verse'].'</b>';
					//echo ' <span class="text_content">'.$r['content'].'</span>';
					echo '<a href="index.php?book='.$r['book'].'">Click here</a>';
					//echo '<a href="details.html">Click here</a>';
					echo '<br>';
				}

    } else {
    	//echo "<p>no request method!</p>";
    }
?>
</body>
</html>