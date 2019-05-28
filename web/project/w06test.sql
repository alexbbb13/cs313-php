create type status as enum ('xActive', 'Blocked', 'Deleted');

create table topic
(    
	 id serial not null primary key,
	 username varchar(100) not null,
    login varchar(40) not null UNIQUE,
    password varchar(40) not null,
    salt varchar(20) not null,
    password_hash varchar(100) not null, 
    status status not null,
    created_at timestamp not null
);

create table freelance_services
(    
	id serial not null primary key,
	user_id integer references users(id),
	title varchar(80) not null,
	subtitle varchar(80),
	description varchar(6000),
	rate_in_cents integer not null,
	active boolean not null,
	created_at timestamp not null	
);

create type job_status as enum ('Open', 'Started', 'Closed', 'Done', 'Deleted');

create table jobs
(    
	id serial not null primary key,
	user_id integer references users(id),
	title varchar(80) not null,
	description varchar(6000),
	rate_in_cents integer not null,
	projected_hours integer,
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

create table messages
(
	id serial not null primary key,
	from_user_id integer references users(id),
	to_user_id integer references users(id),
	title varchar(160),
	text varchar(2000),
	deleted boolean not null,
	created_at timestamp not null	
);	

INSERT INTO users (username,login,password, salt, password_hash, status, created_at)
VALUES ('Tyler Newton','1@mail.ru', 'qqq','salt', '0xPHASH', 'Active', CURRENT_TIMESTAMP);
INSERT INTO users (username,login,password, salt, password_hash, status, created_at)
VALUES ('Maria Dark','2@mail.ru', 'qqq','salt', '0xPHASH', 'Active', CURRENT_TIMESTAMP);
INSERT INTO users (username,login,password, salt, password_hash, status, created_at)
VALUES ('Kyle DeVille','3@mail.ru', 'qqq','salt', '0xPHASH', 'Active', CURRENT_TIMESTAMP);


INSERT INTO jobs (user_id,title,description, rate_in_cents, projected_hours, job_status, created_at)
VALUES ((select id from users where username = 'Alex Brown'),'Create a POSTGRESQL database', 'Create a fancy POSTGRESQL database',2000, 2, 'Open', CURRENT_TIMESTAMP);
INSERT INTO jobs (user_id,title,description, rate_in_cents, projected_hours, job_status, created_at)
VALUES ((select id from users where username = 'Alex Brown'),'Create an Android application', 'Create a fancy Android application',3000, 160, 'Open', CURRENT_TIMESTAMP);


INSERT INTO freelance_services (user_id,title,subtitle, description, rate_in_cents, active, created_at)
VALUES ((select id from users where username = 'Alex Brown'),'Android Developer', 'I am good at developing Android apps','Experienced with Kotlin and Dagger',3000, false, CURRENT_TIMESTAMP);
INSERT INTO freelance_services (user_id,title,subtitle, description, rate_in_cents, active, created_at)
VALUES ((select id from users where username = 'Tyler Newton'),'iOS Developer', 'I am good at developing iOS apps','A Swift and Objective-C guy', 3000, false, CURRENT_TIMESTAMP);
INSERT INTO freelance_services (user_id,title,subtitle, description, rate_in_cents, active, created_at)
VALUES ((select id from users where username = 'Tyler Newton'),'PHP Developer', 'I am equally good at developing PHP apps','I am a PHP fan', 3000, false, CURRENT_TIMESTAMP);
INSERT INTO freelance_services (user_id,title,subtitle, description, rate_in_cents, active, created_at)
VALUES ((select id from users where username = 'Maria Dark'),'Web Designer', 'Web design','Affordable rates for a high quality WEB design', 2000, false, CURRENT_TIMESTAMP);