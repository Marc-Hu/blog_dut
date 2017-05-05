

-- Table tag
create table tag(
    tag_id serial primary key,
    name varchar(50)
);

-- table sujets
create table sujet(
    suj_id serial primary key,
    suj_name varchar(255),
    suj_hide boolean DEFAULT false,
    suj_created_at timestamp default current_timestamp,
    suj_updated_at timestamp default current_timestamp,
    suj_tag integer references tag null
);

-- table members
create table members(
    mem_id serial primary key,
    username varchar(60),
    name varchar(60) default null,
    password varchar(255),
    email varchar(150),
    personal_desc text default null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp
);

-- table messsages
create table messages(
    msg_id serial primary key,
    msg_parent integer references messages default null,
    msg_author integer references members not null,
    msg_subject integer references sujet not null,
    msg_body text,
    created_at timestamp default current_timestamp
);