<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Freelance services</title>
</head>
<body>
<h2>Freelance services</h2>
<br>
<form action="./index.php" method="GET">
  Filter:
  <input name="freelance" type="text">
  <br><br>
  <input type="submit">
</form>

<?php
require 'db.php';
require 'session.php';
//Local or Heroku
function printTable($table) {
	echo'<h2>List of services:</h2><br>';
}

$db = getDb();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // retrieve the form data by using the element's name attributes value as key
           if (isset($_GET['freelance']))
				{
				    $freelance = $_GET['freelance'];
					 $allRows = selectFreelanceByName($db, $freelance);					    
				} else {
				    $allRows = selectFreelanceAll($db);
				}
				foreach($allRows as $r) 
				{
					echo '<b>'.$r['book']." ".$r['chapter'].":".$r['verse'].'</b>';
					//echo ' <span class="text_content">'.$r['content'].'</span>';
					echo '<a href="details.php?id='.$r['id'].'">Click here</a>';
					//echo '<a href="details.html">Click here</a>';
					echo '<br>';
				}

    } else {
    	//echo "<p>no request method!</p>";
    }
?>
</body>
</html>