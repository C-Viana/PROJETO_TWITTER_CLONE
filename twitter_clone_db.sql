create database twitter_clone;
use twitter_clone;

create table usuarios(
	id int not null primary key auto_increment,
	usuario varchar(50) not null,
	email varchar(100) not null,
	senha varchar(32) not null
	
);

update usuarios set senha = '470e89b4f0c81b8ff3f084b8c8ce69ac' where id = 2;


create table tweets(
	id int not null primary key auto_increment,
	id_usuario int not null,
	tweet varchar(140) not null,
	data_inclusao datetime default current_timestamp
	
);

create table usuarios_seguidores(
	id_seguidor int not null primary key auto_increment,
	id_usuario int not null,
	id_seguido int not null,
	data_registro datetime default current_timestamp
	
);

SELECT u.*, us.* FROM usuarios AS u 
LEFT JOIN usuarios_seguidores AS us
ON( us.id_usuario = 2 AND u.id = us.id_seguido)
WHERE u.usuario LIKE '%g%' AND u.id <> 2;

select id_seguido from usuarios_seguidores where id_usuario = 4;

SELECT COUNT(*) AS qtd_tweets FROM tweets WHERE id-_usuario = 3;


INSERT INTO usuarios (usuario, email, senha) VALUES 
('Gilberto Brecht', 'g.brecht@goal.com', md5('brecht') ),
('Alexia Otowiski', 'a.otowiski@luna.com', md5('otowiski') ),
('Altair Sahar', 'a.sahar@gmail.com', md5('sahar') ),
('Hisoka Morow', 'h.morow@hunter.com', md5('morow') ),
('Chris Redfield', 'ch.redfield@rpd.com', md5('redfield') ),
('Claire Redfield', 'cl.redfield@anti.com', md5('redfield') ),
('Regina', 'reg@sort.com', md5('regina') ),
('Dylan Morton', 'd.morton@trat.com', md5('morton') );



