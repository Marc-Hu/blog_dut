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
	AS
		SELECT mem_id, username, name, email, password, personal_desc as desc_uti
			FROM members;


-- RULE

-- avec le nom de l'utilisateur
CREATE or replace RULE member_insert_1 as 
    on INSERT to get_members where NEW.name<>''
  DO instead
    (
		INSERT INTO members(username, name, email, password) values
		(NEW.username, NEW.name, NEW.email, NEW.password);
    );


-- sans les noms de l'utilisateur
CREATE or replace RULE member_insert_2 as 
    on INSERT to get_members where NEW.name=''
  DO instead 
    (
		INSERT INTO members(username, email, password) values
		(NEW.username, NEW.email, NEW.password);
    );

create or replace RULE member_insert_3 as 
	on insert to get_members
  		do instead
    		Nothing;


CREATE OR REPLACE RULE message_insert1 as
	on INSERT to get_messages WHERE msg_parent<>null
		DO instead
		(
			INSERT INTO messages (msg_parent, msg_author, msg_subject, msg_body) values
			(NEW.msg_parent, NEW.msg_author, NEW.msg_subject, NEW.msg_body);
		);

CREATE OR REPLACE RULE message_insert2 as
	on INSERT to get_messages WHERE msg_parent=null
		DO instead
		(
			INSERT INTO messages (msg_author, msg_subject, msg_body) values
			(NEW.msg_author, NEW.msg_subject, NEW.msg_body);
		);

CREATE OR REPLACE RULE message_insert3 as
	on INSERT to get_messages
		DO instead
			NOTHING;