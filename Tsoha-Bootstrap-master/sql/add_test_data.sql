-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO User_table (username, password) VALUES ('santeri', 'santeri');
INSERT INTO User_table (username, password) VALUES ('testaaja', 'testaaja');
INSERT INTO Question (topic, description, added) VALUES ('Turtanat', 'Olen etsinyt laitokselta karhennettuja turtanoita, mutten ole löytänyt mistään. Mikä avuksi?', NOW());
INSERT INTO Question (topic, description, answer, answered, added) VALUES ('Gurula', 'Misä se o? t:yx fuxi', 'DK115', TRUE, NOW());