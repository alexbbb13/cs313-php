<?php

function selectAll($db) {	
	$stmt = $db->query('SELECT id, book, chapter, verse, content FROM scriptures');
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

function listAll($db) {	
	$stmt = $db->query('SELECT * FROM pg_catalog.pg_tables');
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
 *	Login page
 *
 */

function selectByLoginPassword($db, $login, $password) {
	$filteredLogin = filter_var($login, FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
	$filteredPassword = filter_var($password, FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
	if(null == $filteredLogin || null == $filteredPassword) {
		return null;
	}
	$stmt = $db->prepare('SELECT * FROM users WHERE login=:login AND password=:password');
	$stmt->bindParam(':login', $filteredLogin, PDO::PARAM_STR, 40);
	$stmt->bindParam(':password', $filteredPassword, PDO::PARAM_STR, 40);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

/*
 *	Freelancers page
 *
 */

function selectFreelanceByName($db, $name) {
	$filteredName = filter_var($name, FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
	if(null == $filteredName) {
		return null;
	}
	$stmt = $db->prepare('SELECT * FROM freelance_services WHERE title=%:name% OR subtitle=%:name% OR description=title=%:name%');
	$stmt->bindParam(':name', $filteredName, PDO::PARAM_STR, 40);
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

/*
 *	Jobs
 *
 */

function selectJobsByName($db, $name) {
	$filteredName = filter_var($name, FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
	if(null == $filteredName) {
		return null;
	}
	///$stmt = $db->prepare('SELECT * FROM jobs WHERE title=:query OR description=:query');
	$param = "'%".$filteredName."%'";
	$query = 'SELECT * FROM jobs WHERE title LIKE '.$param.' OR description LIKE '.$param;
	$stmt = $db->query($query);
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

title varchar(80) not null,
	description varchar(6000),
	rate_in_cents integer not null,
	projected_hours 

function selectJobsById($db, $id) {
	$filteredId = filter_var($id, FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
	if(null == $filteredLogin) {
		return null;
	}
	$stmt = $db->prepare('SELECT id, users.username, title, description, rate_in_cents, projected_hours FROM jobs WHERE id=:id inner join users on jobs.user_id=users.id');
	$stmt->bindParam(':id', $filteredId, PDO::PARAM_STR, 40);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}


function selectJobsAll($db) {
	$stmt = $db->query('SELECT * FROM jobs');
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