/*
*Auther Mikael Falck
*Database for Project in web programing course.
*course DT100G
*/
/*Create the database if it doesn't exists*/
CREATE DATABASE IF NOT EXISTS bloggProject;

/*Use the database*/
USE bloggProject;

/*Create the table for posts if not already exists.*/
CREATE TABLE IF NOT EXISTS textForPost(
	id INT NOT NULL AUTO_INCREMENT, /*Create id colum.*/
	postDate DATE NOT NULL, /*Keeps the date of the post*/
	postText MEDIUMTEXT NOT NULL, /*To keep the text of the post*/
	PRIMARY KEY(id) /*Set id as primary key*/
)CHARSET=latin1;/*Sets the kkeyboard entry to west eurpe*/

/*Create table for admin information*/
CREATE TABLE IF NOT EXISTS COMMON(
	name VARCHAR(30) NOT NULL,
	trust VARCHAR(100) NOT NULL,
	PRIMARY KEY(name)
)CHARSET=latin1;

INSERT INTO COMMON (name,trust)
VALUES ("admin", "livetsmening");