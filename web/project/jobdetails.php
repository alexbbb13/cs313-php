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
require 'session.php';
//Local or Heroku
function printTable($allRows) {
	echo'<h2>Job Details:</h2><br>';
	echo '<table class="fancy">';
	echo '<tr>';
	echo '<th>Created by</th>';
    echo '<th>Title</th>';
    echo '<th>Job description</th>';
    echo '<th>Rate</th>';
    echo '<th>Hours</th>';
    echo '<th>Action</th>';
    echo ' </tr>';
	foreach($allRows as $r) 
				{
					echo '<tr>';
					echo '<td>'.$r['username'].'</td>';
					echo '<td>'.$r['title'].'</td>';
					echo '<td>'.$r['description'].'</td>';
					$money  = $r['rate_in_cents']/100;
					setlocale(LC_MONETARY, 'en_US');
                    echo '<td>'.money_format('%(#10n', $money).'</td>';
					echo '<td>'.$r['projected_hours'].'</td>';
					echo '<td><a href="apply.php?id='.$r['id'].'">Apply</a></td>';
					echo '</tr>';
				}
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
					printTable($allRows);
				}

    } else {
    	//echo "<p>no request method!</p>";
    }
?>
</body>
</html>