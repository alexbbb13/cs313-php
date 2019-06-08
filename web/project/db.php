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

function insertUser($db, $username, $login, $password) {
	$filteredUsername = filter_var($username, FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
	$filteredLogin = filter_var($login, FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
	$filteredPassword = filter_var($password, FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
	if(null == $filteredLogin || null == $filteredPassword || null == $filteredUsername) {
		return null;
	}
	$status = 'Active';
	$stmt = $db->prepare('INSERT INTO users (username, login, password, status, created_at) VALUES (:username,:login,:password,:status, CURRENT_TIMESTAMP)');
	$stmt->bindParam(':username', $filteredUsername, PDO::PARAM_STR, 40);
	$stmt->bindParam(':login', $filteredLogin, PDO::PARAM_STR, 40);
	$stmt->bindParam(':password', $filteredPassword, PDO::PARAM_STR, 80);
	$stmt->bindParam(':status', $status, PDO::PARAM_STR, 80);
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


function selectFreelanceByIdUser($db, $id, $user) {
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

function selectFreelanceById($db, $id) {
	$filteredId = filter_var($id, FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
	if(null == $filteredId) {
		return null;
	}
	$stmt = $db->prepare('SELECT freelance_services.id, users.username, freelance_services.title, freelance_services.subtitle, freelance_services.description, freelance_services.rate_in_cents FROM freelance_services INNER JOIN users on freelance_services.user_id=users.id WHERE freelance_services.id=:id');
	$stmt->bindParam(':id', $filteredId, PDO::PARAM_INT);
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

function deleteFreelanceService($db, $userId, $freelanceServiceId){
	$stmt = $db->prepare('DELETE FROM freelance_services WHERE id=:freelanceServiceId  AND user_id=:user_id');
	$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
	$stmt->bindParam(':freelanceServiceId', $freelanceServiceId, PDO::PARAM_INT);
	$stmt->execute();
}

/*
'SELECT freelance_services.id, users.username, freelance_services.title, freelance_services.subtitle, freelance_services.description, freelance_services.rate_in_cents FROM freelance_services INNER JOIN users on freelance_services.user_id=users.id WHERE freelance_services.id=:id AND users.id=:user'
*/

function updateFreelanceService($db, $userId, $freelanceServiceId, $title, $subtitle, $description, $rate_in_cents){
	$stmt = $db->prepare('UPDATE freelance_services SET title=:title, subtitle=:subtitle, description=:description, rate_in_cents=:rate_in_cents, active=:active WHERE id=:freelanceServiceId AND user_id=:user_id');
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
	$stmt = $db->prepare('SELECT jobs.id, users.username, users.id as job_user_id, jobs.title, jobs.description, jobs.rate_in_cents, jobs.projected_hours FROM jobs INNER JOIN users on jobs.user_id=users.id WHERE jobs.id=:id');
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

function selectJobsAllUser($db, $user) {
	$stmt = $db->prepare('SELECT * FROM jobs WHERE user_id=:user');
	$stmt->bindParam(':user', $user, PDO::PARAM_STR, 40);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

function selectJobByIdUser($db, $id, $user) {
	$filteredId = filter_var($id, FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
	if(null == $filteredId) {
		return null;
	}
	$filteredUserId = filter_var($user, FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
	if(null == $filteredId || null == $filteredUserId) {
		return null;
	}
	$stmt = $db->prepare('SELECT jobs.id, users.username, jobs.title, jobs.description, jobs.rate_in_cents, jobs.projected_hours FROM jobs INNER JOIN users on jobs.user_id=users.id WHERE jobs.id=:id AND jobs.user_id=:$user');
	$stmt->bindParam(':id', $filteredId, PDO::PARAM_INT);
	$stmt->bindParam(':user', $filteredUserId, PDO::PARAM_INT);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

function deleteJob($db, $userId, $jobId){
	$stmt = $db->prepare('DELETE FROM jobs WHERE id=:jobId  AND user_id=:user_id');
	$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
	$stmt->bindParam(':jobId', $jobId, PDO::PARAM_INT);
	$stmt->execute();
}

function updateJob($db, $user, $jobId, $title, $description, $rate_in_cents, $projectedHours){
	$stmt = $db->prepare('UPDATE jobs SET 
		title=:title, 
		description=:description, 
		rate_in_cents=:rate_in_cents,
		projected_hours=:projectedHours
		WHERE 
		id=:jobId 
		AND user_id=:user_id');
	$active = true;
	$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
	$stmt->bindParam(':title', $title, PDO::PARAM_STR, 40);
	$stmt->bindParam(':description', $description, PDO::PARAM_STR, 2000);
	$stmt->bindParam(':rate_in_cents', $rate_in_cents, PDO::PARAM_INT);
	$stmt->bindParam(':projectedHours', $projectedHours, PDO::PARAM_STR, 20);
	$stmt->bindParam(':jobId', $jobId, PDO::PARAM_INT);
	$stmt->execute();
}

function insertJob($db, $userId, $title, $description, $rate_in_cents, $projectedHours){
	$stmt = $db->prepare('INSERT INTO jobs (user_id, title, description, rate_in_cents, projected_hours, job_status, created_at) VALUES (:user_id, :title, :description, :rate_in_cents, :projected_hours, :job_status, CURRENT_TIMESTAMP)');
	$jobStatus = 'Open';
	$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
	$stmt->bindParam(':title', $title, PDO::PARAM_STR, 40);
	$stmt->bindParam(':description', $description, PDO::PARAM_STR, 2000);
	$stmt->bindParam(':rate_in_cents', $rate_in_cents, PDO::PARAM_INT);
	$stmt->bindParam(':projected_hours', $projectedHours, PDO::PARAM_STR, 20);
	$stmt->bindParam(':job_status', $jobStatus, PDO::PARAM_STR, 20);
	$stmt->execute();
	return $db->lastInsertId('jobs_id_seq');
}


/*
		Applications
create table jobs
(    
	id serial not null primary key,
	user_id integer references users(id),
	title varchar(80) not null,
	description varchar(6000),
	rate_in_cents integer not null,
	projected_hours NUMERIC (4,2),
	job_status job_status not null,
	created_at timestamp not null	
);

create table applications
(
	id serial not null primary key,
	job_id integer references jobs(id),
	user_id integer references users(id),
	freelance_service_id integer references freelance_services(id),
	rate_in_cents integer not null,
	projected_hours integer,
	cover_letter varchar(2000),
	accepted boolean not null,
	created_at timestamp not null	
);

*/

function selectApplications($db, $jobId, $freelanceId, $userId) {
	$stmt = $db->prepare('SELECT * FROM applications WHERE job_id=:jobId AND user_id=:userId AND freelance_service_id=:freelanceId');
	$stmt->bindParam(':jobId', $jobId, PDO::PARAM_INT);
	$stmt->bindParam(':freelanceId', $freelanceId, PDO::PARAM_INT);
	$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

function selectAllApplicationsForMyJob($db, $jobId, $userId) {
	$stmt = $db->prepare('
		SELECT
            jobs.id as jobsId,
  			applications.id as applicationId,
  			jobs.user_id as clientUserId,
  			applications.user_id as freelancerUserId,
  			applications.freelance_service_id as freelancerServiceId,
  			freelance_services.title,
  			applications.rate_in_cents,
  			applications.projected_hours
		FROM
  			jobs
  		INNER JOIN applications on jobs.id = applications.job_id
  		INNER JOIN freelance_services on applications.freelance_service_id = freelance_services.id
		WHERE
  			jobs.id = :jobId
  			AND jobs.user_id = :userId
		');
	$stmt->bindParam(':jobId', $jobId, PDO::PARAM_INT);
	$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

function selectAllApplicationsForUser($db, $userId) {
	$stmt = $db->prepare('
		SELECT
            jobs.id as jobsId,
  			applications.id as applicationId,
  			jobs.user_id as clientUserId,
  			applications.user_id as freelancerUserId,
  			applications.freelance_service_id as freelancerServiceId,
  			freelance_services.title,
  			applications.rate_in_cents,
  			applications.projected_hours
		FROM
  			applications
  		INNER JOIN jobs on jobs.id = applications.job_id
  		INNER JOIN freelance_services on applications.freelance_service_id = freelance_services.id
		WHERE
  			applications.user_id = :userId
		');
	$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

function selectOneApplicationForMyJob($db, $jobId, $applicationId, $userId) {
	$stmt = $db->prepare('
		SELECT
  			jobs.id as jobid,
  			applications.id as applicationId,
  			jobs.user_id as clientUserId,
  			applications.user_id as freelancerUserId,
  			applications.freelance_service_id as freelancerServiceId,
  			freelance_services.title,
  			applications.rate_in_cents,
  			applications.rate_in_cents,
  			applications.projected_hours,
  			applications.cover_letter
		FROM
  			jobs
  		INNER JOIN applications on jobs.id = applications.job_id
  		INNER JOIN freelance_services on applications.user_id = freelance_services.id
		WHERE
  			jobs.id = :jobId
  			AND jobs.user_id = :userId
  			AND applications.id = :applicationId
		');
	$stmt->bindParam(':jobId', $jobId, PDO::PARAM_INT);
	$stmt->bindParam(':applicationId', $applicationId, PDO::PARAM_INT);
	$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

function insertApplication($db, $jobId, $freelanceId, $userId, $description, $hours,  $rate) {
	$stmt = $db->prepare('
		INSERT INTO applications 
		(job_id, 
		user_id, 
		freelance_service_id, 
		rate_in_cents, 
		projected_hours, 
		cover_letter,  
		accepted, 
		created_at) VALUES (
		:jobId, 
		:userId, 
		:freelanceId,
		:rate,
		:hours, 
		:description,
		false, 
		CURRENT_TIMESTAMP)');
	
	$stmt->bindParam(':jobId', $jobId, PDO::PARAM_INT);
	$stmt->bindParam(':freelanceId', $freelanceId, PDO::PARAM_INT);
	$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
	$stmt->bindParam(':description', $description, PDO::PARAM_STR, 2000);
	$stmt->bindParam(':hours', $hours, PDO::PARAM_INT);
	$stmt->bindParam(':rate', $rate, PDO::PARAM_INT);
    $stmt->execute();
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