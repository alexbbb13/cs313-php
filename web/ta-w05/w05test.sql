
/*
Overview
Your assignment is to create a simple database and query it to display results on a PHP page.

Instructions
CORE REQUIREMENTS
Create a new database table called "Scriptures" that has the following columns:

id

book

chapter

verse

content

Insert the following scriptures (along with the text of the verse as content) into your database:

John 1:5

Doctrine and Covenants 88:49

Doctrine and Covenants 93:28

Mosiah 16:9

Step 3: Create a PHP page to query this database and list the scriptures. Put a heading at the top of the page to display "Scripture Resources". Then for each scripture, display the book chapter and verse in bold, followed by a hyphen and then the content of the scripture in quotes. For example:

Scripture Resources

John 3:16 - "For God so loved the world, that he gave his only begotten Son, that whosoever believeth in him should not perish, but have everlasting life."

Proverbs 3:5 - "Trust in the Lord with all thine heart; and lean not unto thine own understanding."

STRETCH CHALLENGES
After finishing the core requirements, ensure that everyone is at that point and understands the material. When everyone has completed the core requirements, you can move on to these stretch challenges.

Create a PHP form to search for a book and display all the scriptures in your database that match that book.

Change your results page so that it only lists the book, chapter, and verse of the scripture (not the content), but make that text a link. Have the link 
lead to a "Scripture Details" page w.here the user can see the content for the selected scripture.

Hint: You might consider adding the scripture id as a query parameter for the details page link.

Build out the Scripture Details page. It should display the reference and the content for the scripture that was clicked.

Instructor's Solution
As a part of this team activity, you are expected to look over a solution from the instructor, to compare your approach to that one. One of the questions on the I-Learn submission will ask you to provide insights from this comparison.

Please DO NOT open the solution until you have worked through this activity as a team for the one hour period. At the end of the hour, if you are still struggling with some of the core requirements, you are welcome to view the instructor's solution and use it to help you complete your own code. Even if you use the instructor's code to help you, you are welcome to report that you finished the core requirements, if you code them up yourself.

After working with your team for the one hour activity, click here for the instructor's solution.

Instructor Tips

If you are trying to create your code in such a way that it can work on both a local development server and at Heroku, without needing to make any code changes, here is an alternative solution that shows a way to that, following the instructions in this week's preparation material.

Submission
When you have finished this activity, please fill out the assessment in I-Learn. You are welcome to complete any additional parts of this activity by yourself or with others after your meeting before submitting the assessment.
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
