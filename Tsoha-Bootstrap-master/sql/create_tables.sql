-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE User_table(
	id SERIAL PRIMARY KEY,
	username varchar(50) NOT NULL,
	password varchar(50) NOT NULL,
        joined DATE
);

CREATE TABLE Question(
	id SERIAL PRIMARY KEY,
	user_id INTEGER REFERENCES User_table(id),
	topic varchar(50) NOT NULL,
	description varchar(400),
	answered BOOLEAN,
	added TIMESTAMP,
        modified TIMESTAMP
);

CREATE TABLE Answer(
        id SERIAL PRIMARY KEY,
        question_id INTEGER REFERENCES Question(id),
        user_id INTEGER REFERENCES User_table(id),
        content varchar(400),
        added TIMESTAMP,
        modified TIMESTAMP
);