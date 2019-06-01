<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Job details</title>
     <link rel = "stylesheet"
          type = "text/css"
          href = "style.css" />
</head>
<body>
<?php
require 'navbar.php';
?>	
<br>
<?php
require 'db.php';
//Local or Heroku

function printRow($name, $value){
	echo '<tr>';
	echo '<th>'.$name.'</th>';
	echo '<td>'.$value.'</td>';
	echo ' </tr>';
}

function printTable($r, $id) {
	echo'<h2>Job Details:</h2><br>
	<table class="fancy">';
	printRow('Created by', $r['username']);
	printRow('Title', $r['title']);
	printRow('Job description', $r['description']);
	$money  = $r['rate_in_cents']/100;
	setlocale(LC_MONETARY, 'en_US');
	printRow('Rate', money_format('%(#10n', $money));
	printRow('Projected Hours', $r['projected_hours']);
	printRow('Action', '<a href="apply.php?id='.$r['id'].'">Click to apply</a></td>');
	echo '</table>';			
}

$db = getDb();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // retrieve the form data by using the element's name attributes value as key
           if (isset($_GET['id']))
					{
					    $filter = $_GET['id'];
						$allRows = selectJobsById($db, $filter);					    
					} else {
					    echo '<b>Error!</b>';
					}
				if(sizeof($allRows) > 0) {
					printTable($allRows[0], $filter);
				}

    } else {
    	//echo "<p>no request method!</p>";
    }
?>
</body>
</html>