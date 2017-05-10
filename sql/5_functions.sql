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
$$ LANGUAGE plpgsql
security definer;

-- Get sujet by id
CREATE OR REPLACE FUNCTION get_subject_by_id(in id integer)
RETURNS TABLE (nom varchar, crea timestamp, modif timestamp, tag integer) AS
$$
  SELECT suj_name, suj_created_at, suj_updated_at, suj_tag 
    FROM get_sujets
      WHERE suj_id=$1;
$$ language SQL;

CREATE OR REPLACE FUNCTION get_member_by_id(in id int)
RETURNS TABLE (id integer, username varchar, name varchar, email varchar, desc_uti text) AS
$$
  SELECT mem_id, username, name, email, desc_uti
    FROM get_members
      WHERE mem_id=$1;
$$ LANGUAGE sql
security definer;

-- create user
CREATE OR REPLACE FUNCTION signup(signup_username varchar, signup_name varchar, signup_email varchar, signup_password varchar)
RETURNS void AS
$$
  INSERT INTO get_members(username, name, email, password) VALUES (signup_username, signup_name, signup_email, signup_password);
$$ LANGUAGE sql;

CREATE OR REPLACE FUNCTION signup_no_name(signup_username varchar, signup_email varchar, signup_password varchar)
RETURNS void AS
$$
  INSERT INTO get_members(username, email, password) VALUES (signup_username, signup_email, signup_password);
$$ LANGUAGE sql;

--check if username and password are correct when signup, return true or false
CREATE OR REPLACE FUNCTION verifUtilisateur(in nom_utilisateur varchar, in mdp varchar, out id integer, out verif boolean)
RETURNS SETOF RECORD AS
$$
DECLARE
  nom varchar;
  motdepasse varchar ;
  curseur CURSOR FOR
    SELECT mem_id, username, password from get_members where username=nom_utilisateur;
BEGIN
  id:=(-1);
  verif:=false;
  open curseur;
  FETCH curseur into id, nom, motdepasse;
  if nom = nom_utilisateur and motdepasse=mdp then
    verif:=true;
    return next;
  else
    return next;
  end if;
  close curseur;
END;
$$ LANGUAGE plpgsql
security definer;


--Modif desc profil
create or replace function modifDesc(in nom_utilisateur varchar, in new_desc text)
RETURNS void AS
$$
  UPDATE get_members SET desc_uti=new_desc, username=nom_utilisateur where username=nom_utilisateur;
$$ language sql
security definer;


--modif name
create or replace function modifName(in nom_utilisateur varchar, in new_name varchar)
RETURNS void AS
$$
  UPDATE get_members SET name=new_name, username=nom_utilisateur where username=nom_utilisateur;
$$ language sql
security definer;

--modif password
create or replace function modifPassword(in nom_utilisateur varchar, in new_password varchar)
RETURNS void AS
$$
  UPDATE get_members SET password=new_password, username=nom_utilisateur where username=nom_utilisateur;
$$ language sql
security definer;

--modif email
create or replace function modifEmail(in nom_utilisateur varchar, in new_email varchar)
RETURNS void AS
$$
  UPDATE get_members SET email=new_email, username=nom_utilisateur where username=nom_utilisateur;
$$ language sql
security definer;

--ajout d'un post avec un tag
create or replace function ajoutPostAvecTag(in titre varchar, in tagNum integer)
Returns void AS
$$
  INSERT INTO get_sujets(suj_name, suj_tag) VALUES (titre, tagNum);
$$ language sql;

--ajout d'un post sans tag
create or replace function ajoutPostSansTag(in titre varchar)
Returns void AS
$$
  INSERT INTO get_sujets(suj_name, suj_tag) VALUES (titre, null);
$$ language sql;

--ajout d'un message
create or replace function ajoutMessage(in parent integer, in auteur integer, in sujet integer, in contenu text)
Returns void AS
$$
  INSERT INTO get_messages(msg_parent, msg_author, msg_subject, msg_body) VALUES (parent, auteur, sujet, contenu);
$$ language sql
security definer;

create or replace function ajoutMessage_no_parent(in auteur integer, in sujet integer, in contenu text)
Returns void AS
$$
  INSERT INTO get_messages(msg_author, msg_subject, msg_body) VALUES (auteur, sujet, contenu);
$$ language sql
security definer;

--modifie le contenu d'un message
create or replace function modifMessage(in idMess integer, in contenu text)
Returns void as
$$
  UPDATE get_messages SET msg_body=contenu where msg_id=idMess;
$$ language sql;


CREATE OR REPLACE FUNCTION messages_fils(in pere integer)
RETURNS TABLE (id integer, auteur integer, contenu text, creation timestamp) AS
$$
  SELECT msg_id, msg_author, msg_body, created_at 
      FROM get_messages
        WHERE msg_parent=pere
          ORDER BY msg_id ASC;
$$ language SQL;

CREATE OR REPLACE FUNCTION messages_sujet(in sujet integer)
RETURNS TABLE (id integer, auteur integer, contenu text, creation timestamp) AS
$$

SELECT msg_id, msg_author, msg_body, created_at 
    FROM get_messages
      WHERE msg_subject=sujet AND msg_parent is null
        ORDER BY msg_id ASC;
$$ language SQL;

--renvoie un tableau qui contient tous les sujets d'un tag entré en paramètre
CREATE OR REPLACE FUNCTION sujet_tag(in tag integer)
RETURNS TABLE (id integer, nom varchar, crea timestamp, modif timestamp, tag integer) AS
$$
  SELECT suj_id, suj_name, suj_created_at, suj_updated_at, suj_tag 
    FROM get_sujets
      WHERE suj_tag=tag AND suj_hide=false
        ORDER BY suj_id ASC;
$$ language SQL;

