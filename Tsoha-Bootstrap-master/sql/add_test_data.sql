-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Admin (name, password) VALUES ('santeri', 'santeri');
INSERT INTO Admin (name, password) VALUES ('kalle', 'ilves');
INSERT INTO Question (topic, description, added) VALUES ('Turtanat', 'Olen etsinyt laitokselta karhennettuja turtanoita, mutten ole löytänyt mistään. Mikä avuksi?', NOW());
INSERT INTO Question (topic, description, answer, answered, added) VALUES ('Gurula', 'Misä se o? t:yx fuxi', 'DK115', TRUE, NOW());