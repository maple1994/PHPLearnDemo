create table session(
sess_id varchar(40) not null,
sess_content text,
primary key(sess_id)
)engine=myisam charset=utf8;