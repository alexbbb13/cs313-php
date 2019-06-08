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

<br>
<br>
<form action="./freelance.php" method="GET">
  Filter:
  <input name="filter" type="text">
  <input type="submit" value="Filter">
  <br><br>
</form>

<?php
require 'db.php';
//Local or Heroku
showTitle();

function showTitle() {
	$my = ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['my']) && $_GET['my']== true && getSessionUser()!=null);
		if ($my) {
			echo'<h2>My Freelance Services:</h2><br>';			
		} else {
			echo'<h2>Freelance Services:</h2><br>';
		}
}

function showAddNewButton() {
	echo 
    '<br><form action="freelanceedit.php" method="GET">
	<input type="submit" value="Create New Freelance Service" >
	</form><br>';
}

function printTable($allRows, $editable) {
	echo '<table class="fancy">';
	echo '<tr>';
	echo '<th>Title</th>';
    echo '<th>Short Description</th>';
    echo '<th>Rate</th>';
    if ($editable) { 
    	echo '<th>Action</th>'; 
    } else {
    	echo '<th>More</th>';
    }
    echo ' </tr>';
	foreach($allRows as $r) 
				{
					echo '<tr>';
					echo '<td>'.$r['title'].'</td>';
					echo '<td>'.$r['subtitle'].'</td>';
					$money  = $r['rate_in_cents']/100;
					setlocale(LC_MONETARY, 'en_US');
                    echo '<td>'.money_format('%(#10n', $money).'</td>';
					if ($editable) { 
						echo '<td><a href="freelanceedit.php?id='.$r['id'].'">Edit</a></td>';
					} else {
						echo '<td><a href="freelancedetails.php?id='.$r['id'].'">More</a></td>';
					}
					echo '</tr>';
				}
	echo '</table>';			
}

$db = getDb();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	        $my = isset($_GET['my']) && $_GET['my']== true && getSessionUser()!=null;
	        if ( isset($_GET['filter']) && $_GET['filter'] !== '')
           		{
					    $filter = htmlspecialchars($_GET['filter']);
						if ($my) {
							showAddNewButton();
							$allRows = selectFreelanceByNameUser($db, $filter, getSessionUser());
						} else {
							$allRows = selectFreelanceByName($db, $filter);					    
						} 
				} else {
						if ($my) {
							showAddNewButton();
							$allRows = selectFreelanceAllUser($db, getSessionUser());
						} else {
							$allRows = selectFreelanceAll($db);					    
						}
					    
				}
				if(sizeof($allRows) > 0) {
					printTable($allRows, $my === true);
				}
} 
?>
</body>
</html>