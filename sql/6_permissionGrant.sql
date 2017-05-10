GRANT SELECT ON get_tags TO blog;
GRANT SELECT ON get_sujets TO blog;
GRANT SELECT ON get_messages TO blog;
GRANT SELECT ON count_valid_subjects TO blog;

GRANT EXECUTE ON function signup(signup_username varchar, signup_name varchar, signup_email varchar, signup_password varchar) to blog;
GRANT EXECUTE ON function signup_no_name(signup_username varchar, signup_email varchar, signup_password varchar) to blog;
GRANT EXECUTE ON function verifUtilisateur( nom_utilisateur varchar,  mdp varchar) to blog;
GRANT EXECUTE ON function modifDesc(nom_utilisateur varchar, new_desc text) to blog;
GRANT EXECUTE ON function is_valid_username(username varchar) to blog;
GRANT EXECUTE ON function get_member_by_id(id int) to blog;
GRANT EXECUTE ON function meme_username_dans_bdd(pseudo varchar) to blog;
GRANT EXECUTE ON function meme_email_dans_bdd(nouveaumail varchar) to blog;

GRANT INSERT ON get_members TO blog;

GRANT USAGE, SELECT ON SEQUENCE members_mem_id_seq TO BLOG;
