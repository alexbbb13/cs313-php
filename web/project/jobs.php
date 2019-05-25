<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Available jobs</title>
     <link rel = "stylesheet"
          type = "text/css"
          href = "style.css" />
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
	echo '<table class ="fancy">';
	echo '<tr>';
    echo '<th>Title</th>';
    echo '<th>Job description</th>';
    echo '<th>Rate</th>';
    echo '<th>Hours</th>';
    echo '<th>Details</th>';
    echo ' </tr>';
	foreach($allRows as $r) 
				{
					echo '<tr>';
					echo '<td>'.$r['title'].'</td>';
					echo '<td>'.$r['description'].'</td>';
					$money  = $r['rate_in_cents']/100;
					setlocale(LC_MONETARY, 'en_US');
                    echo '<td>'.money_format('%(#10n', $money).'</td>';
					echo '<td>'.$r['projected_hours'].'</td>';
					echo '<td><a href="jobdetails.php?id='.$r['id'].'">Job details</a></td>';
					echo '</tr>';
				}
	echo '</table>';			
}

$db = getDb();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // retrieve the form data by using the element's name attributes value as key
           if (isset($_GET['filter']) && $_GET['filter'] !== '')
					{
					    $filter = $_GET['filter'];
						$allRows = selectJobsByName($db, $filter);					    
					} else {
					    $allRows = selectJobsAll($db);
					}
				if(sizeof($allRows) > 0) {
					printTable($allRows);
				}

    } 
?>
</body>
</html>