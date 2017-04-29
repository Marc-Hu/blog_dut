-- Get 10 sujects for 'min' tuples 
CREATE OR REPLACE FUNCTION get_sujet_by_part(min int)
  RETURNS TABLE(
  	id integer,
    name varchar,
    hide boolean,
    created_at timestamp,
    updated_at timestamp,
    tag integer
  	) AS
$$
BEGIN
   	RETURN QUERY
   	SELECT * 
   		FROM get_sujets        
        	LIMIT 10 OFFSET $1; 
END
$$  LANGUAGE plpgsql;

-- return number of identical username
CREATE OR REPLACE FUNCTION is_valid_username(username varchar)
  RETURNS TABLE(nb bigint) AS
$$
BEGIN
  RETURN QUERY
  SELECT count(m.username)
    FROM get_members as m
      WHERE m.username=$1;
END;
$$ LANGUAGE plpgsql;

-- create user
CREATE OR REPLACE FUNCTION signup(signup_username varchar, signup_name varchar, signup_email varchar, signup_password varchar)
RETURNS void AS
$$
  INSERT INTO get_members(username, name, email, password) VALUES (signup_username, signup_name, signup_email, signup_password);
$$ LANGUAGE sql;

--check if username and password are correct, return true or false

CREATE OR REPLACE FUNCTION verifUtilisateur(in nom_utilisateur varchar, in mdp varchar)
RETURNS boolean AS
$$
DECLARE
  nom varchar := null;
  motdepasse varchar := null;
  curseur CURSOR FOR
    SELECT username, password from get_members where username=nom_utilisateur;
BEGIN
  open curseur;
  FETCH curseur into nom, motdepasse;
  if nom = nom_utilisateur and motdepasse=mdp then
    return true;
  end if;
  return false;
  close curseur;
END;
$$ LANGUAGE plpgsql;

--Modif desc profil
create or replace function modifDesc(in nom_utilisateur varchar, in new_description text)
RETURNS boolean AS
$$
  DECLARE
    verif int := 0;
  BEGIN
    UPDATE get_members SET desc_uti=new_description where username=nom_utilisateur;
    verif:=sql%rowcount;
    if verif = 1 then
      return true;
    end if;
    return false;
  END;
$$ language plpgsql;
/*
--modif name
create or replace function modifName(in nom_utilisateur varchar, in new_name varchar)
RETURNS void AS
$$
  UPDATE get_members SET name=new_name where username=nom_utilisateur;
$$ language sql;

--modif password
create or replace function modifPassword(in nom_utilisateur varchar, in new_password varchar)
RETURNS void AS
$$
  UPDATE get_members SET password=new_password where username=nom_utilisateur;
$$ language sql;

--modif email
create or replace function modifEmail(in nom_utilisateur varchar, in new_email varchar)
RETURNS void AS
$$
  UPDATE get_members SET email=new_email where username=nom_utilisateur;
$$ language sql;
*/