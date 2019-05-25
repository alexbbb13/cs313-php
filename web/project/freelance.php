<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Freelance services</title>
    <link rel = "stylesheet"
          type = "text/css"
          href = "style.css" />
</head>
<body>
<?php
require 'navbar.php';
?>	

<h2>Freelance services</h2>
<br>
<form action="./freelance.php" method="GET">
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
	echo'<h2>Freelance services:</h2><br>';
	echo '<table class="fancy">';
	echo '<tr>';
	echo '<th>Title</th>';
    echo '<th>Short Description</th>';
    echo '<th>Rate</th>';
    echo '<th>Action</th>';
    echo ' </tr>';
	foreach($allRows as $r) 
				{
					echo '<tr>';
					echo '<td>'.$r['title'].'</td>';
					echo '<td>'.$r['subtitle'].'</td>';
					$money  = $r['rate_in_cents']/100;
					setlocale(LC_MONETARY, 'en_US');
                    echo '<td>'.money_format('%(#10n', $money).'</td>';
					echo '<td><a href="freelancedetails.php?id='.$r['id'].'">More Info</a></td>';
					echo '</tr>';
				}
	echo '</table>';			
}

$db = getDb();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // retrieve the form data by using the element's name attributes value as key
           if ( isset($_GET['filter']) && $_GET['filter'] !== '')
					{
					    $filter = $_GET['filter'];
						$allRows = selectFreelanceByName($db, $filter);					    
					} else {
					    $allRows = selectFreelanceAll($db);
					}
				if(sizeof($allRows) > 0) {
					printTable($allRows);
				}
    } 
?>
</body>
</html>