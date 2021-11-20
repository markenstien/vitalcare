drop table if exists dota_hero_abilities;
create table dota_hero_abilities(
	id int(10) not null primary key auto_increment ,
	name varchar(100),
	abilities text,
	talents text,

	created_at timestamp default now()
);