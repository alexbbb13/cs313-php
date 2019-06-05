create table ta07_users
(    
	id serial not null primary key,
	login varchar(40) not null UNIQUE,
    password varchar(200) not null
);
