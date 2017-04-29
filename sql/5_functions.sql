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
  SELECT count(mem_id)
    FROM get_members as m
      WHERE m.username=$1;
END;
$$ LANGUAGE plpgsql;

-- create user
CREATE OR REPLACE FUNCTION signin(signin_username varchar, signin_name varchar, signin_email varchar, signin_password varchar)
RETURNS void AS
$$
  INSERT INTO get_members(username, name, email, password) VALUES (signin_username, signin_name, signin_email, signin_password);
$$ LANGUAGE sql;