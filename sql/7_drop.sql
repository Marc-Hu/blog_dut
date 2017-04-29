-- drop function
DROP FUNCTION if exists get_sujet_by_part(int);
drop function if exists signin(varchar,varchar,varchar,varchar);

-- RULE
drop RULE if exists member_insert_1 on get_members;
drop RULE if exists member_insert_2 on get_members;
drop RULE if exists member_insert_3 on get_members;

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