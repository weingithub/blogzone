create database if not exists blog character set utf8;

create table if not exists blog.articles
(
	id int(11) auto_increment primary key,
	userid varchar(30) not null,
	title varchar(120) not null,
	tagid  int default 0,	
	brief blob not null,
	cid int not null,
	star  int default 0,
	times TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	isdel tinyint default 0
)default charset=utf8;

create table if not exists blog.content
(
	id int(11) auto_increment primary key,
	content longblob not null
)default charset=utf8;

create table if not exists blog.tags
(
	id int(11) auto_increment primary key,
	tagname varchar(40) not null
)default charset=utf8;

create table if not exists blog.users
(
	userid varchar(40) primary key,
	passwd varchar(35) not null
)default charset=utf8;

insert into blog.tags(tagname) values("c/c++"), ("python"),("protobuf"),("随笔"),("转载");

/*创建数据库*/
create database tool;

create table if not exists tool.harrypotter
(
	id int(11) auto_increment primary key,
	vocabulary varchar(128) unique,
	page  int(11) default 0,
	seq tinyint default 0, /*注释的序号*/
	phonogram_eng varchar(256), /*英国音标*/
	phonogram_us varchar(256),	/*美国音标*/
	pronounce_eng varchar(1024), /*英国发音链接*/
	pronounce_us varchar(1024), /*美国发音链接*/
	meaning varchar(256)
)default charset=utf8;

