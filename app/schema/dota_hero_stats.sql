
drop table if exists dota_hero_stats;
create table dota_hero_stats(
	id int(10) not null primary key auto_increment,
	name varchar(100),
	localized_name varchar(100),
	info text,
	created_at timestamp default now()
);