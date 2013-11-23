/* Create database if it does not exist  */
CREATE DATABASE IF NOT EXISTS derpcms;

/* Use the derpcms database  */
USE derpcms;

/* Drop tables if exists */
DROP TABLE IF EXISTS projects;

/* Create Tables */
CREATE TABLE projects(
	id	int(11) unsigned PRIMARY KEY AUTO_INCREMENT NOT NULL,
	pubdate date NOT NULL,
	title	varchar(255) NOT NULL,
	summary	varchar(255) NOT NULL,
	image	varchar(255) NULL, 	/* Optional Image Location*/
	content text(65535) NOT NULL,
	further varchar(255) NULL 	/* Optional Sidebar Links */
);

