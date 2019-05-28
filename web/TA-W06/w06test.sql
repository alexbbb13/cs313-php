/*
Week 05
*/

create table scriptures
(  
	id serial not null primary key,
	book varchar(40) not null,
    chapter integer not null,
    verse integer not null,
    content text not null
);

INSERT INTO scriptures (book, chapter, verse, content) VALUES 
('John',1,5,'And the light shineth in darkness; and the darkness comprehended it not.'),
('Doctrine and Covenants',88,49,'The light shineth in darkness, and the darkness comprehendeth it not; nevertheless, the day shall come when you shall comprehend even God, being quickened in him and by him.'),
('Doctrine and Covenants',93,28,'He that keepeth his commandments receiveth truth and light, until he is glorified in truth and knoweth all things.'),
('Mosiah',16,9,'He is the light and the life of the world; yea, a light that is endless, that can never be darkened; yea, and also a life which is endless, that there can be no more death.');
);

/*
Week 06
*/

create table topic {
	id serial not null primary key,
	name varchar(40) not null
};

create table scripturetopic {
	id serial not null primary key,
	scripture_id integer references scriptures(id),
	topic_id integer references topic(id)
};

INSERT INTO topic (name) VALUES ('Faith'), ('Sacrifice'), ('Charity');
