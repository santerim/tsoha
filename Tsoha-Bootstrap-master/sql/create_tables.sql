-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE User_table(
	id SERIAL PRIMARY KEY,
	username varchar(50) NOT NULL,
	password varchar(50) NOT NULL
);

CREATE TABLE Question(
	id SERIAL PRIMARY KEY,
	user_id INTEGER REFERENCES User_table(id),
	topic varchar(50) NOT NULL,
	description varchar(400),
	answer varchar(400),
	answered BOOLEAN,
	added DATE,
        modified DATE
);