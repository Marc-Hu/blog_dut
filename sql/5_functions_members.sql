CREATE OR REPLACE FUNCTION controle_inscription()
RETURNS TRIGGER AS
$$ 
BEGIN
  	controle integer := 0;
	set controle = (Select count(*) FROM get_members where username=NEW.username or email=NEW.email);
	if TG_OP='INSERT' and controle = 0 then
		INSERT INTO get_members(username, name, email, password) VALUES (NEW.username, NEW.name, NEW.email, NEW.password);
	END IF;
	set controle = (SELECT COUNT(*) FROM get_members where username=NEW.username);
	if TG_OP='UPDATE' and controle = 0 then
		
	RETURN NULL;
END;
$$ language plpgsql;


CREATE or replace trigger controle_inscription_trig
	BEFORE
	INSERT or UPDATE
	on get_members
	for each row
	execute PROCEDURE controle_inscription();