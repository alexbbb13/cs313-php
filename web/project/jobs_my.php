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
<?php
require 'navbar.php';
?>	
	
<h2>My Open Jobs:</h2>
<br>
<br><form action="jobedit.php" method="GET">
	<input type="submit" value="Create new job" >
	</form><br>';


<?php
require 'db.php';
//Local or Heroku
function printTable($allRows) {
	echo '<table class ="fancy">';
	echo '<tr>';
    echo '<th>Title</th>';
    echo '<th>Job description</th>';
    echo '<th>Rate</th>';
    echo '<th>Hours</th>';
    echo '<th>Details</th>';
    echo '<th>Applications</th>';
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
					echo '<td><a href="applications.php?job_id='.$r['id'].'">Applications</a></td>';
					echo '</tr>';
				}
	echo '</table>';			
}

$db = getDb();
if (getSessionUser()!=null) {
    $allRows = selectJobsAllUser($db, getSessionUser());
}
if(sizeof($allRows) > 0) {
	printTable($allRows);
}
?>
</body>
</html>