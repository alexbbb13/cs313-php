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
//Local or Heroku
function showAddNewButton() {
	echo 
	'<form action="freelanceedit.php" method="GET">
	<submit>Add New</submit>
	</form>';
}

function printTable($allRows, $editable) {
	echo'<h2>Freelance services:</h2><br>';
	echo '<table class="fancy">';
	echo '<tr>';
	echo '<th>Title</th>';
    echo '<th>Short Description</th>';
    echo '<th>Rate</th>';
    if ($editable) { 
    	echo '<th>Action</th>'; 
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
					    $filter = $_GET['filter'];
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