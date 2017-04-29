-- GET Messages
CREATE OR REPLACE VIEW get_messages
	AS
		SELECT *
			FROM messages;

-- GET sujets
CREATE OR REPLACE VIEW get_sujets
	AS
		SELECT *
			FROM sujet
				WHERE suj_hide=false
					ORDER BY suj_created_at DESC;

-- Get Tags
CREATE OR REPLACE VIEW get_tags
	AS
		SELECT * from tag;

-- return number of subject not hidden
CREATE OR REPLACE VIEW count_valid_subjects
	AS
		SELECT COUNT(suj_id)
			FROM sujet
				WHERE suj_hide=False;

-- 
CREATE OR REPLACE VIEW get_members
	(username, name, mail, password)																																																																																																																																																																														
	AS
		SELECT *
			FROM members;


-- RULE

-- avec le nom de l'utilisateur
CREATE or replace RULE member_insert_1 as 
    on INSERT to get_members where NEW.name<>''
  DO instead
    (
		INSERT INTO members(username, name, email, password) values
		(NEW.username, NEW.name, NEW.mail, NEW.password);
    );

-- sans les noms de l'utilisateur
CREATE or replace RULE member_insert_2 as 
    on INSERT to get_members where NEW.name=''
  DO instead 
    (
		INSERT INTO members(username, email, password) values
		(NEW.username, NEW.mail, NEW.password);
    );