-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO User_table (username, password, joined) VALUES ('santeri', 'santeri', NOW());
INSERT INTO User_table (username, password, joined) VALUES ('testaaja', 'testaaja', NOW());
INSERT INTO Question (topic, description, answered, added) VALUES ('Muu', 'Olen etsinyt laitokselta karhennettuja turtanoita, mutten ole löytänyt mistään. Mikä avuksi?', TRUE, NOW());
INSERT INTO Question (topic, description, answered, added) VALUES ('Laitos', 'Misson kurula? t:yx fuxi', TRUE, NOW());
INSERT INTO Answer (question_id, content, added) VALUES (1, 'Soitto mielenterveyspäivystykseen', now());
INSERT INTO Answer (question_id, content, added) VALUES (2, 'DK115', now());