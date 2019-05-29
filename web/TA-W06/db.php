<?php

function selectAllScriptures($db) {	
	$stmt = $db->query('SELECT id, book, chapter, verse, content FROM scriptures');
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

function selectTopics($db, $id) {	
	$stmt = $db->prepare('SELECT name FROM scripturetopic JOIN topics ON scripturetopic.topic_id =topics.id WHERE scripture_id=:id');
	$stmt->execute(array(':id' => $id));
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

function insertScripture($db,$book, $chapter, $verse, $content) {

	$stmt = $db->prepare('INSERT INTO scriptures (book, chapter, verse, content) VALUES (:book, :chapter, :verse, :content)');
	$stmt->execute(array(':book' => $book , ':chapter' => $chapter, ':verse' => $verse, ':content' => $content ));
	//$sth->bindParam(':calories', $calories, PDO::PARAM_INT);
    //$sth->bindValue(':colour', "%{$colour}%");
    $stmt->execute();
    return $db->lastInsertId('scriptures_id_seq');
	//return $stmt->lastInsertId('scriptures_id_seq');
}

function insertScriptureTopic($db, $lastRow, $selected) {
	$stmt = $db->prepare('INSERT INTO scripturetopic (scripture_id, topic_id) VALUES (:lastRow, :selected)');
	$stmt->bindParam(':lastRow', $lastRow, PDO::PARAM_INT);
	$stmt->bindParam(':selected', $selected, PDO::PARAM_INT);
	$stmt->execute();
}

function selectAllScripturesWithTopics($db) {	
	$stmt = $db->query('SELECT * FROM scriptures JOIN scripturetopic USING(id)');
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

function selectAllTopics($db) {	
	$stmt = $db->query('SELECT id,name FROM topics');
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

function selectById($db, $id) {	
	$stmt = $db->prepare('SELECT * FROM scriptures WHERE id=:id');
	$stmt->execute(array(':id' => $id));
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

function selectByBook($db, $book) {	
	$stmt = $db->prepare('SELECT * FROM scriptures WHERE book=:book');
	$stmt->execute(array(':book' => $book));
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

/*
 *	Db
 *
 */


function getDb()
{
	return getHerokuDb();
}

function getHerokuDb() {
	try
	{
	  $dbUrl = getenv('DATABASE_URL');

	  $dbOpts = parse_url($dbUrl);

	  $dbHost = $dbOpts["host"];
	  $dbPort = $dbOpts["port"];
	  $dbUser = $dbOpts["user"];
	  $dbPassword = $dbOpts["pass"];
	  $dbName = ltrim($dbOpts["path"],'/');
	  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
	  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  return $db;
	}
	catch (PDOException $ex)
	{
	  echo 'Error!: ' . $ex->getMessage();
	  die();
	}
}

function getLocalDb(){
	try
	{
	  $user = 'alex';
	  $password = 'alex';

/*
     $db = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=postgres');
     */
	  $db = new PDO('pgsql:host=localhost;dbname="alex"', $user, $password);

	  // this line makes PDO give us an exception when there are problems,
	  // and can be very helpful in debugging! (But you would likely want
	  // to disable it for production environments.)
	  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $ex)
	{
	  echo 'Error!: ' . $ex->getMessage();
	  die();
   }
   return $db;
}

?>