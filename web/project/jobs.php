<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Available jobs</title>
</head>
<body>
<h2>Available jobs</h2>
<br>
<form action="./jobs.php" method="GET">
  Filter:
  <input name="filter" type="text">
  <br><br>
  <input type="submit">
</form>

<?php
require 'db.php';
require 'session.php';
//Local or Heroku
function printTable($allRows) {
	echo'<h2>Jobs:</h2><br>';
	echo '<table>';
	echo '<tr>';
   echo '<th>id</th>';
   echo '<th>First name</th>';
   echo '<th>Last name</th>';
   echo '<th>email</th>';
   echo ' </tr>';

	foreach($allRows as $r) 
				{
					echo '<b>'.$r['book']." ".$r['chapter'].":".$r['verse'].'</b>';
					//echo ' <span class="text_content">'.$r['content'].'</span>';
					echo '<a href="details.php?id='.$r['id'].'">Click here</a>';
					//echo '<a href="details.html">Click here</a>';
					echo '<br>';
				}
	echo '</table>';			
}

$db = getDb();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // retrieve the form data by using the element's name attributes value as key
           if (isset($_GET['filter']))
					{
					    $filter = $_GET['filter'];
						 $allRows = selectJobsByName($db, $filter);					    
					} else {
					    $allRows = selectJobsAll($db);
					}
				if(sizeof($allRows) > 0) {
					printTable($allRows);
				}

    } else {
    	//echo "<p>no request method!</p>";
    }
?>
</body>
</html>