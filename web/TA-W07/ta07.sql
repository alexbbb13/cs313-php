create table users
(    
	id serial not null primary key,
	login varchar(40) not null UNIQUE,
    password_hash varchar(200) not null, 
);
