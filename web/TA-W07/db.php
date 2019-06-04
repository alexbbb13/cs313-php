<?php

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

function insertUser($db, $login, $password) {
	$filteredLogin = filter_var($login, FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
	$filteredPassword = filter_var($password, FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
	if(null == $filteredLogin || null == $filteredPassword) {
		return null;
	}
	$stmt = $db->prepare('INSERT INTO users (login, password) VALUES (:login,:password)');
	$stmt->bindParam(':login', $filteredLogin, PDO::PARAM_STR, 40);
	$stmt->bindParam(':password', $filteredPassword, PDO::PARAM_STR, 40);
	$stmt->execute();
	return $db->lastInsertId('users_id_seq');
}

function selectByLogin($db, $login) {
	$filteredLogin = filter_var($login, FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
	if(null == $filteredLogin) {
		return null;
	}
	$stmt = $db->prepare('SELECT * FROM users WHERE login=:login');
	$stmt->bindParam(':login', $filteredLogin, PDO::PARAM_STR, 40);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}


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