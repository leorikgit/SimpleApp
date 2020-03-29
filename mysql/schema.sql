CREATE DATABASE app;
USE app;
CREATE TABLE users ( id smallint unsigned not null auto_increment primary key ,
                    username varchar(30) not null,
                    password varchar(250) not null,
                    email varchar (255) not null,
                    group_id varchar (255) not null,
                    img varchar (255),
                    token varchar (256),
                    created_at timestamp default current_timestamp,
                    updated_at timestamp );
CREATE TABLE `groups` ( id smallint unsigned not null auto_increment primary key ,
                     name varchar(30) not null,
                     permissions varchar(255) not null,
                     created_at timestamp default current_timestamp,
                     updated_at timestamp );
INSERT INTO users ( username, email, password, `group_id` ) VALUES ( 'Admin', 'admin@gmail.com', 123123, 2 );
INSERT INTO `groups` ( name, permissions) VALUES ("admin",'{"admin": "1", "moderator": "1"}');
INSERT INTO `groups` ( name, permissions) VALUES ("user",'{"admin": "0", "moderator": "0"}');
CREATE TABLE artists ( id smallint unsigned not null auto_increment primary key ,
                       name varchar(255) not null,
                       created_at timestamp default current_timestamp,
                       updated_at timestamp );
CREATE TABLE genres ( id smallint unsigned not null auto_increment primary key ,
                      name varchar(255) not null,
                      created_at timestamp default current_timestamp,
                      updated_at timestamp );
CREATE TABLE albums ( id smallint unsigned not null auto_increment primary key ,
                      title varchar(255) not null,
                      artist int not null,
                      genre int not null,
                      art_work_path varchar(255),
                      created_at timestamp default current_timestamp,
                      updated_at timestamp );
CREATE TABLE songs ( id smallint unsigned not null auto_increment primary key ,
                     title varchar(255) not null,
                     album int not null,
                     artist int not null,
                     genre int not null,
                     duration varchar(255) not null,
                     path varchar(255) not null,
                     album_order int not null,
                     play_count int not null,
                     created_at timestamp default current_timestamp,
                     updated_at timestamp );
CREATE TABLE playlists ( id smallint unsigned not null auto_increment primary key ,
                       name varchar(255) not null unique ,
                       owner int not null,
                       created_at timestamp default current_timestamp,
                       updated_at timestamp );
CREATE TABLE songs_playlist(id smallint unsigned not null auto_increment primary key,
                            playlist_id int not null,
                            song_id int not null,
                            song_order int not null,
                           created_at timestamp default current_timestamp,
                           updated_at timestamp );



