create table members (
    num int not null auto_increment,
    id char(15) not null,
    pass char(15) not null,
    name char(10) not null,
    phone varchar(20) not null,
    age int not null,
    gender varchar(10) not null,
    address varchar(100) not null,
    hobby varchar(255),
    regist_day datetime,
    introduction text,
    file_name varchar(255),
    file_type varchar(255),
    file_copied varchar(255),
    level int,
    musiciant varchar(10) not null,
    primary key (num)
);
