drop table fetch_game_logs;
create table fetch_game_logs(
    id int(10) not null primary key auto_increment,
    recent_reset date comment 'if date today and this date is 12 days then reset',
    recent_fetch date,
    created_at timestamp default now()
);



insert into fetch_game_logs(recent_reset , recent_fetch)
    VALUES(DATE('2021-11-12') , '2021-11-12');