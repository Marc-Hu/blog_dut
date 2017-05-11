-- tags
INSERT INTO tag(name) VALUES
('Chat'),
('Chien'),
('Chevaux'),
('Moustique'),
('Fourmi'),
('Rat');

INSERT INTO members(username, name, email, password, personal_desc) values
('bigfan', 'tony', 'tony@merde.com', 'testtest', 'Et merde !'),
('geron', 'marc', 'marc@merde.com', 'testtest', 'Et les merdeux !'),
('skyro', 'steeve', 'steeve@merde.com', 'testtest', 'C est merdoyant !'),
('fragile', 'bastien', 'bastien@merde.com', 'testtest', '#JeSuisFragile');

-- sujet
INSERT INTO sujet(suj_name, suj_hide, suj_tag, suj_author)  values 
('Comment mon chat peut-il devenir cool sur internet ?', false, 1, 2),
('Comment adopter un chat ?', true, 1, 3),
('J aime les chevaux.', false, 3, 3),
('J aime les chevaux - 2.', false, 3, 1),
('Ou pourrais-je trouver une cage pour mon rat domestique ?', false, 6, 1),
('Comment les habitants de la cité de villiers ce sont ensortie avec l invasion des rats ?', false, 6, 1);


INSERT INTO messages(msg_parent, msg_author, msg_subject, msg_body) values
(null, 3, 2, 'J aimerais avoir un chat, mais de couleur noir et blanc si possible. mais je ne sais pas ou chercher.'),
(1, 1, 2, 'Dans une animalerie peut-être XD.'),
(null, 2, 4, 'Connaisser vous unitato ?.'),
(3, 4, 4, 'Le mélange entre une patate et une licorne');