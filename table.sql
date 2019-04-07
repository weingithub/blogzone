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

create table if not exists blog.admins
(
	userid varchar(40) primary key,
	passwd varchar(35) not null
)default charset=utf8;

insert into blog.tags(tagname) values("c/c++"), ("python"),("protobuf"),("随笔"),("转载"),("私密");

/*评论表*/
create table if not exists blog.comments
(
    id bigint auto_increment primary key,
    article_id int(11) not null,  /*评论的文章id*/
    name varchar(64) not null,  /*评论者名称*/
    comm_content longblob not null,  /*评论的内容*/
    comm_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP /*评论的时间*/
)ENGINE=innodb default charset=utf8;

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

/*创建strip html标记的函数*/
delimiter ||
DROP FUNCTION IF EXISTS strip_tags||
CREATE FUNCTION strip_tags( x longtext) RETURNS longtext
LANGUAGE SQL NOT DETERMINISTIC READS SQL DATA
BEGIN
DECLARE sstart INT UNSIGNED;
DECLARE ends INT UNSIGNED;
SET sstart = LOCATE('<', x, 1);
REPEAT
SET ends = LOCATE('>', x, sstart);
SET x = CONCAT(SUBSTRING( x, 1 ,sstart -1) ,SUBSTRING(x, ends +1 )) ;
SET sstart = LOCATE('<', x, 1);
UNTIL sstart < 1 END REPEAT;
set x=replace(x, "&nbsp;", "");
set x=replace(x, "&amp;", "");
set x=replace(x, "&lt;", "");
set x=replace(x, "&gt;", "");
set x=replace(x, "&quot;", "");
set x=replace(x, "&qpos;", "");
return x;
END;
||
delimiter ;
						      
/*上面那个函数似乎无效，后面我又试了个新函数*/						      
DELIMITER ||  
CREATE FUNCTION `strip_tags`( Dirty longtext CHARSET utf8)  
RETURNS longtext CHARSET utf8
 
DETERMINISTIC   
BEGIN  
  DECLARE iStart, iEnd, iLength int;  
    WHILE Locate( '<', Dirty ) > 0 And Locate( '>', Dirty, Locate( '<', Dirty )) > 0 DO  
      BEGIN  
        SET iStart = Locate( '<', Dirty ), iEnd = Locate( '>', Dirty, Locate('<', Dirty ));  
        SET iLength = ( iEnd - iStart) + 1;  
        IF iLength > 0 THEN  
          BEGIN  
            SET Dirty = Insert( Dirty, iStart, iLength, '');  
          END;  
        END IF;  
      END;  
    END WHILE;  
    RETURN Dirty;  
END;  
||
delimiter ;
