CREATE DATABASE primrose;
USE primrose;

create table suppliers(
supplier_id int NOT NULL auto_increment, 
primary key(supplier_id),
supplier_name varchar(255)
);

INSERT INTO suppliers VALUES(1,'Garden Beauty');
INSERT INTO suppliers VALUES(2,'Small Lion');
INSERT INTO suppliers VALUES(3,'Hozemock');
INSERT INTO suppliers VALUES(4,'Queens Quality Seeds');
INSERT INTO suppliers VALUES(5,'Lo - Gear');
INSERT INTO suppliers VALUES(6,'BYOB');
INSERT INTO suppliers VALUES(7,'MX Sales');

create table addresses(
address_id int NOT NULL  auto_increment,
primary key (address_id),
address_line_1 varchar(100), 
address_line_2 varchar(100),
town varchar(100), 
post_code varchar(20),
telephone varchar(20),
fax varchar(20),
email varchar(100)
);
INSERT INTO addresses VALUES(1,223,'','London','AB 1234 CD','07 - 9522 - 1462','','myemail@primrose.co.uk');
INSERT INTO addresses VALUES(2,'7 Dunglass House','Shrubbery','Newbury','RG14 6HP','+421 907157945',123456789,'myhovercraftisfullofeels@primrose.co.uk');
INSERT INTO addresses VALUES(3,'5 baytree terrace',"Jamie's Den",'Reading','RG14 BLA',87541384,'','tstme@primrose.co.uk');
INSERT INTO addresses VALUES(4,'20 Eastgate','','Reading','RG14 OMG',07897118181,4571111891,'whysoserious@primrose.co.uk');
INSERT INTO addresses VALUES(5,'A nice place','to live','Newbury','RG17 HD',123456789,5148741618,'holyhandgrenade@primrose.co.uk');
INSERT INTO addresses VALUES(6,'This address ',' doens''t work properly','London','AB1234',544871181,'','ministry_of_silly_walks@primrose.co.uk');
INSERT INTO addresses VALUES(7,'Yet Another nice place ',' to live','Newbury','RG17 HD',97151818,'','myownemail@primrose.co.uk');

create table supplier_addresses(
supplier_address_id int NOT NULL auto_increment,
supplier_id integer,
address_id integer,foreign key(supplier_id) references suppliers(supplier_id), foreign key(address_id) references addresses(address_id),
 primary key(supplier_address_id)
);
INSERT INTO supplier_addresses VALUES(1,1,6);
INSERT INTO supplier_addresses VALUES(2,2,5);
INSERT INTO supplier_addresses VALUES(3,4,1);
INSERT INTO supplier_addresses VALUES(4,5,3);
INSERT INTO supplier_addresses VALUES(5,6,2);
INSERT INTO supplier_addresses VALUES(6,7,4);
INSERT INTO supplier_addresses VALUES(7,2,7);

