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
<br>

<?php
require 'db.php';
require 'session.php';
//Local or Heroku
function printTable($allRows) {
	echo'<h2>Freelance service:</h2><br>';
	echo '<table class="fancy">';
	echo '<tr>';
	echo '<th>Name</th>';
    echo '<th>Title</th>';
    echo '<th>Short description</th>';
    echo '<th>Long description</th>';
    echo '<th>Rate</th>';
    echo ' </tr>';
	foreach($allRows as $r) 
				{
					echo '<tr>';
					echo '<td>'.$r['username'].'</td>';
					echo '<td>'.$r['title'].'</td>';
					echo '<td>'.$r['subtitle'].'</td>';
					echo '<td>'.$r['description'].'</td>';
					$money  = $r['rate_in_cents']/100;
					setlocale(LC_MONETARY, 'en_US');
                    echo '<td>'.money_format('%(#10n', $money).'</td>';
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
						$allRows = selectFreelanceById($db, $filter);					    
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