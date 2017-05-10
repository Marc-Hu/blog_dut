-- drop function
DROP FUNCTION if exists get_sujet_by_part(int);
drop function if exists get_subject_by_id(int);
drop function if exists get_member_by_id(int);
drop function if exists is_valid_username(varchar);
drop function if exists signup(varchar,varchar,varchar,varchar);
drop function if exists signup_no_name(varchar,varchar,varchar);
drop function if exists verifUtilisateur(varchar, varchar);
drop function if exists modifName(varchar, varchar);
drop function if exists modifDesc(varchar, text);
drop function if exists modifMessage(integer, text);
drop function if exists modifPassword(varchar, varchar);
drop function if exists modifEmail(varchar, varchar);
drop function if exists ajoutPostAvecTag(varchar, integer);
drop function if exists ajoutPostSanstag(varchar);
drop function if exists ajoutMessage(integer, integer, integer, text);
drop function if exists ajoutMessage_no_parent(integer, integer, text);
drop function if exists messages_fils(integer);
drop function if exists messages_sujet(integer);
drop function if exists sujet_tag(integer);
drop function if exists meme_username_dans_bdd(varchar);
drop function if exists meme_email_dans_bdd(varchar);

-- RULE
drop RULE if exists member_insert_1 on get_members;
drop RULE if exists member_insert_2 on get_members;
drop RULE if exists member_insert_3 on get_members;
drop RULE if exists member_update_1 on get_members;
drop RULE if exists member_update_2 on get_members;
drop RULE if exists member_update_3 on get_members;
drop RULE if exists member_update_4 on get_members;
drop RULE if exists member_update_5 on get_members;
drop RULE if exists message_insert1 on get_messages;
drop RULE if exists message_insert2 on get_messages;
drop RULE if exists message_insert3 on get_messages;


-- drop view
drop view if exists get_sujets;
drop view if exists get_tags;
drop view if exists get_messages;
drop view if exists get_members;
drop view if exists count_valid_subjects;

-- drop table
drop table if exists messages;
drop table if exists sujet;
drop table if exists tag;
drop table if exists members;