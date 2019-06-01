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
	$param = "'%".$filteredName."%'";
	$query = 'SELECT * FROM freelance_services WHERE title LIKE '.$param.' OR description LIKE '.$param.' OR subtitle LIKE '.$param;
	$stmt = $db->query($query);
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

function selectFreelanceByNameUser($db, $name, $user) {
	$filteredName = filter_var($name, FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
	if(null == $filteredName) {
		return null;
	}
	$filteredUser = filter_var($user, FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
	if(null == $filteredUser) {
		return null;
	}
	$param = "'%".$filteredName."%'";
	$query = 'SELECT * FROM freelance_services WHERE user_id='.$user.' AND (title LIKE '.$param.' OR description LIKE '.$param.' OR subtitle LIKE '.$param.')';
	$stmt = $db->query($query);
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}


function selectFreelanceById($db, $id, $user) {
	$filteredId = filter_var($id, FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
	if(null == $filteredId) {
		return null;
	}
	$stmt = $db->prepare('SELECT freelance_services.id, users.username, freelance_services.title, freelance_services.subtitle, freelance_services.description, freelance_services.rate_in_cents FROM freelance_services INNER JOIN users on freelance_services.user_id=users.id WHERE freelance_services.id=:id AND users.id=:user');
	$stmt->bindParam(':id', $filteredId, PDO::PARAM_INT);
	$stmt->bindParam(':user', $user, PDO::PARAM_INT);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

function selectFreelanceAll($db) {
	$stmt = $db->query('SELECT * FROM freelance_services');
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

function selectFreelanceAllUser($db, $user) {
	$stmt = $db->prepare('SELECT * FROM freelance_services WHERE user_id=:user');
	$stmt->bindParam(':user', $user, PDO::PARAM_STR, 40);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

/*
id serial not null primary key,
	user_id integer references users(id),
	title varchar(80) not null,
	subtitle varchar(80),
	description varchar(6000),
	rate_in_cents integer not null,
	active boolean not null,
	created_at timestamp not null	
*/
function insertFreelanceService($db, $userId, $title, $subtitle, $description, $rate_in_cents){
	$stmt = $db->prepare('INSERT INTO freelance_services (user_id, title, subtitle, description, rate_in_cents, active, created_at) VALUES (:user_id, :title, :subtitle, :description, :rate_in_cents, :active, CURRENT_TIMESTAMP)');
	$active = true;
	$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
	$stmt->bindParam(':title', $title, PDO::PARAM_STR, 40);
	$stmt->bindParam(':subtitle', $subtitle, PDO::PARAM_STR, 40);
	$stmt->bindParam(':description', $description, PDO::PARAM_STR, 2000);
	$stmt->bindParam(':rate_in_cents', $rate_in_cents, PDO::PARAM_INT);
	$stmt->bindParam(':active', $active, PDO::PARAM_INT);
	$stmt->execute();
	return $db->lastInsertId('freelance_services_id_seq');
}

function updateFreelanceService($db, $userId, $freelanceServiceId, $title, $subtitle, $description, $rate_in_cents){
	$stmt = $db->prepare('UPDATE freelance_services SET user_id=:user_id, title:title, subtitle:subtitle, description:description, rate_in_cents:rate_in_cents, active:active WHERE id=:freelanceServiceId');
	$active = true;
	$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
	$stmt->bindParam(':title', $title, PDO::PARAM_STR, 40);
	$stmt->bindParam(':subtitle', $subtitle, PDO::PARAM_STR, 40);
	$stmt->bindParam(':description', $description, PDO::PARAM_STR, 2000);
	$stmt->bindParam(':rate_in_cents', $rate_in_cents, PDO::PARAM_INT);
	$stmt->bindParam(':active', $active, PDO::PARAM_INT);
	$stmt->bindParam(':freelanceServiceId', $freelanceServiceId, PDO::PARAM_INT);
	$stmt->execute();
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

function selectJobsById($db, $id) {
	$filteredId = filter_var($id, FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
	if(null == $filteredId) {
		return null;
	}
	$stmt = $db->prepare('SELECT jobs.id, users.username, jobs.title, jobs.description, jobs.rate_in_cents, jobs.projected_hours FROM jobs INNER JOIN users on jobs.user_id=users.id WHERE jobs.id=:id');
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
   	$dbUrl = "postgres://joe:joe@localhost:5432/joe";
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
   return $db;
}



?>