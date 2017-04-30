CREATE OR REPLACE FUNCTION meme_username_dans_bdd(in pseudo varchar, in nouveaumail varchar)
RETURNS BOOLEAN AS
$$
DECLARE
	controle integer:=0;
	curseur CURSOR for
		Select count(*) FROM get_members where username=pseudo OR email=nouveaumail;
BEGIN
	OPEN curseur;
	FETCH curseur into controle;
	exit when not found;
	if controle = 0 then
		return false;
	end if;
	CLOSE curseur;
	return true;
END;
$$ language PLPGSQL;

CREATE OR REPLACE FUNCTION controle_inscription()
RETURNS TRIGGER AS
$$ 
DECLARE
  	controle INT;
BEGIN
	if meme_username_dans_bdd = false then
		INSERT INTO get_members(username, name, email, password) VALUES (NEW.username, NEW.name, NEW.email, NEW.password);
	END IF;
	RETURN NULL;
END;
$$ language plpgsql;


CREATE trigger controle_inscription_trig
	BEFORE
	INSERT
	on members
	for each row
	execute PROCEDURE controle_inscription();