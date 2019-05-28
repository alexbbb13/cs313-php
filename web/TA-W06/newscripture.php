<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Freelance services</title>
</head>
<body>
<?php
require('db.php');
$db = getDb();
$topics = getTopics($db);
?>
<h2>Freelance services</h2>
<br>
<form action="submitscripture.php" method="GET">
  Book:
  <input name="book" type="text"><br>
  Chapter:
  <input name="chapter" type="text"><br>
  Verse:
  <input name="verse" type="text"><br>
  <textarea name ="content" rows="6" cols="50"></textarea>
    <?php
    foreach($topics as $t) {
    	$name = $t['name'];
    	echo '<input type="checkbox" name="$name" value="$name"><label for="$name"> $name </label><br>';
    }
    ?>
  <input type="submit">
</form>

</body>
</html>