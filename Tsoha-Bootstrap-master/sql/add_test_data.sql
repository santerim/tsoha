-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO User_table (username, password) VALUES ('santeri', 'santeri');
INSERT INTO User_table (username, password) VALUES ('testaaja', 'testaaja');
INSERT INTO Question (topic, description, answered, added) VALUES ('Turtanat', 'Olen etsinyt laitokselta karhennettuja turtanoita, mutten ole löytänyt mistään. Mikä avuksi?', TRUE, NOW());
INSERT INTO Question (topic, description, answered, added) VALUES ('Gurula', 'Misä se o? t:yx fuxi', TRUE, NOW());
INSERT INTO Answer (question_id, content, added) VALUES (1, 'Soitto mielenterveyspäivystykseen', now());
INSERT INTO Answer (question_id, content, added) VALUES (2, 'DK115', now());