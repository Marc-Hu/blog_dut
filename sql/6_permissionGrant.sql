GRANT SELECT ON get_tags TO blog;
GRANT SELECT ON get_sujets TO blog;
GRANT SELECT ON get_messages TO blog;
GRANT SELECT ON count_valid_subjects TO blog;



GRANT INSERT ON get_members TO blog;

GRANT USAGE, SELECT ON SEQUENCE members_mem_id_seq TO BLOG;