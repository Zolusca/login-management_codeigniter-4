CREATE TABLE user(
    id varchar(20) not null primary key,
    email varchar(20) not null unique ,
    username varchar(20) not null  ,
    password varchar(225) not null
)Engine=innodb;
