-- database creation script

CREATE DATABASE IF NOT EXISTS addressBook;

USE addressBook;

CREATE TABLE IF NOT EXISTS city (
		id CHAR(3) NOT NULL PRIMARY KEY,
		name VARCHAR(64)
	);

CREATE TABLE IF NOT EXISTS contact (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		firstName VARCHAR(64) NOT NULL,
		lastName VARCHAR(64) NOT NULL,
		street VARCHAR(64),
		zipCode CHAR(5),
		cityId CHAR(3) NOT NULL,
                FOREIGN KEY (cityId) REFERENCES city(id)
	);
