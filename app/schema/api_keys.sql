create table api_keys(
	id int(10) not null primary key auto_increment,
	api enum('leauge_of_legends' , 'dota' , 'ml'),
	api_secret text,
	api_key text,

	created_at timestamp default now(),
	updated_at timestamp default now() ON UPDATE now()
);



INSERT INTO api_keys(api , api_secret , api_key)
	VALUES('leauge_of_legends' , 'RGAPI-44a7a4c6-5201-4b30-87df-d31c58df348a' , 'RGAPI-44a7a4c6-5201-4b30-87df-d31c58df348a'),
	('dota' , 'RGAPI-44a7a4c6-5201-4b30-87df-d31c58df348a' , 'RGAPI-44a7a4c6-5201-4b30-87df-d31c58df348a'),
	('ml' , 'RGAPI-44a7a4c6-5201-4b30-87df-d31c58df348a' , 'RGAPI-44a7a4c6-5201-4b30-87df-d31c58df348a');