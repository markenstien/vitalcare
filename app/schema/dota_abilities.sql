drop table dota_abilities;
create table dota_abilities(
	id int(10) not null primary key auto_increment,
	name varchar(100), 
	dname varchar(100), 
	behavior varchar(100), 
	dmg_type varchar(100),
	bkbpierce varchar(10),
	description varchar(200), 
	attrib text,
	mc varchar(50), 
	cd varchar(50), 
	img varchar(100),
	created_at timestamp default now()
);