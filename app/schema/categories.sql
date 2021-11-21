create table categories(
	id int(10) not null primary key auto_increment,
	category varchar(100) not null,
	cat_key	varchar(50) not null,
	description text,
	created_by int(10),
	created_at timestamp default now()
);