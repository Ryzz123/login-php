CREATE  DATABASE  Db_user;

CREATE TABLE user (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    username VARCHAR(20) NOT NULL ,
    password VARCHAR(255) NOT NULL ,
    confirm VARCHAR(255) NOT NULL
) ENGINE = InnoDB;


SELECT  * FROM user;

DELETE user FROM user WHERE username = 'febri';
