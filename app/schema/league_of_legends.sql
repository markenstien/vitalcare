create table league_of_legends(
	id int(10) not null primary key auto_increment,
	match_id varchar(100),
	meta_data text,
	info text,

	created_at timestamp default now()
);


create database game_stats;