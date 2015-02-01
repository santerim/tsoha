-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Admin(
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL,
	password varchar(50) NOT NULL
);

CREATE TABLE Question(
	id SERIAL PRIMARY KEY,
	user_id INTEGER REFERENCES Admin(id),
	topic varchar(50) NOT NULL,
	description varchar(400),
	answer varchar(400),
	added DATE
);