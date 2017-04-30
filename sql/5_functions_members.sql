CREATE OR REPLACE FUNCTION meme_username_dans_bdd(in pseudo varchar)
RETURNS BOOLEAN AS
$$
DECLARE
	controle integer:=0;
	curseur CURSOR for
		Select count(*) FROM get_members where username=pseudo;
BEGIN
	OPEN curseur;
	FETCH curseur into controle;
	exit when not found;
	if controle = 0 then
		CLOSE curseur;
		return false;
	end if;
	CLOSE curseur;
	return true;
END;
$$ language PLPGSQL;

CREATE OR REPLACE FUNCTION meme_email_dans_bdd(in nouveaumail varchar)
RETURNS BOOLEAN AS
$$
DECLARE
	controle integer:=0;
	curseur CURSOR for
		Select count(*) FROM get_members where email=nouveaumail;
BEGIN
	OPEN curseur;
	FETCH curseur into controle;
	exit when not found;
	if controle = 0 then
		CLOSE curseur;
		return false;
	end if;
	CLOSE curseur;
	return true;
END;
$$ language PLPGSQL;
