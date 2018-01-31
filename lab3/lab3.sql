DROP TABLE IF EXISTS lab3;
CREATE TABLE `Classes`(
	Name varchar(50) NOT NULL,
	department varchar(50) NOT NULL,
	course_id varchar(6) NOT NULL,
	PRIMARY KEY(`course_id`),
	`start` time NOT NULL,
	`end` time NOT NULL,
	days varchar(10) NOT NULL
);
