CREATE DATABASE IF NOT EXISTS board;
GRANT SELECT, INSERT, UPDATE, DELETE ON board.*
    TO board_root@localhost 
    IDENTIFIED BY 'board_root';
FLUSH PRIVILEGES;

USE board;

CREATE TABLE IF NOT EXISTS user (
    id          INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    username    VARCHAR(20) NOT NULL,
    name        VARCHAR(20) NOT NULL,
    email       VARCHAR(30) NOT NULL,
    password    VARCHAR(40) NOT NULL,
    PRIMARY KEY (id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS thread (
    id       INT (10) UNSIGNED NOT NULL AUTO_INCREMENT,
    title    VARCHAR(30) NOT NULL,
    created  TIMESTAMP NOT NULL,
    user_id  INT(10) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES user(id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS comment (
    id         INT (10) UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id    INT (10) NOT NULL,
    thread_id  INT UNSIGNED NOT NULL,
    username   VARCHAR(255) NOT NULL,
    body       TEXT(200) NOT NULL,
    created    TIMESTAMP NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (thread_id) references thread(id)
    INDEX (thread_id, created)
)ENGINE=InnoDB;



